<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineOptions({
    layout: AuthenticatedLayout,
})

const props = defineProps({
    books: {
        type: Object,
        required: true,
    },
})

const pencarian = ref('')

const daftarBuku = computed(() => {
    const data = Array.isArray(props.books)
        ? props.books
        : (props.books?.data ?? [])

    const kata = pencarian.value.toLowerCase().trim()

    if (!kata) {
        return data
    }

    return data.filter((buku) =>
        [
            buku.kode_buku,
            buku.judul,
            buku.pengarang,
            buku.penerbit,
            buku.tahun,
        ].some((nilai) =>
            String(nilai ?? '').toLowerCase().includes(kata)
        )
    )
})

function hapusBuku(id) {
    if (confirm('Apakah kamu yakin ingin menghapus buku ini?')) {
        router.delete(route('books.destroy', id), {
            preserveScroll: true,
        })
    }
}
</script>

<template>
    <Head title="Data Buku" />

    <div class="min-h-screen bg-gray-100">
        <div class="mx-auto max-w-7xl">

            <!-- Header halaman -->
            <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        Data Buku Perpustakaan Mini
                    </h1>

                    <p class="mt-2 text-gray-600">
                        Kelola data buku perpustakaan dengan mudah.
                    </p>
                </div>

                <Link
                    :href="route('books.create')"
                    class="rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white shadow hover:bg-blue-700"
                >
                    + Tambah Buku
                </Link>
            </div>

            <!-- Tabel data buku -->
            <div class="overflow-hidden rounded-xl bg-white shadow-md">

                <!-- Pencarian -->
                <div class="flex flex-wrap items-center justify-between gap-4 border-b p-5">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">
                            Daftar Buku
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Total: {{ daftarBuku.length }} buku
                        </p>
                    </div>

                    <input
                        v-model="pencarian"
                        type="text"
                        placeholder="Cari buku..."
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 outline-none focus:border-blue-500 sm:w-64"
                    />
                </div>

                <!-- Isi tabel -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="px-5 py-4">No.</th>
                                <th class="px-5 py-4">Kode Buku</th>
                                <th class="px-5 py-4">Judul Buku</th>
                                <th class="px-5 py-4">Pengarang</th>
                                <th class="px-5 py-4">Penerbit</th>
                                <th class="px-5 py-4">Tahun</th>
                                <th class="px-5 py-4">Stok</th>
                                <th class="px-5 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            <tr
                                v-for="(buku, index) in daftarBuku"
                                :key="buku.id"
                                class="hover:bg-gray-50"
                            >
                                <td class="px-5 py-4">
                                    {{ index + 1 }}
                                </td>

                                <td class="px-5 py-4">
                                    {{ buku.kode_buku }}
                                </td>

                                <td class="px-5 py-4 font-semibold text-gray-800">
                                    {{ buku.judul }}
                                </td>

                                <td class="px-5 py-4">
                                    {{ buku.pengarang }}
                                </td>

                                <td class="px-5 py-4">
                                    {{ buku.penerbit }}
                                </td>

                                <td class="px-5 py-4">
                                    {{ buku.tahun }}
                                </td>

                                <td class="px-5 py-4">
                                    <span
                                        class="rounded-full px-3 py-1 text-xs font-semibold"
                                        :class="Number(buku.stok) > 0
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-red-100 text-red-700'"
                                    >
                                        {{ buku.stok }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <Link
                                            :href="route('books.edit', buku.id)"
                                            class="rounded-md bg-yellow-400 px-3 py-2 font-medium text-gray-900 hover:bg-yellow-500"
                                        >
                                            Edit
                                        </Link>

                                        <button
                                            type="button"
                                            @click="hapusBuku(buku.id)"
                                            class="rounded-md bg-red-600 px-3 py-2 font-medium text-white hover:bg-red-700"
                                        >
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr v-if="daftarBuku.length === 0">
                                <td
                                    colspan="8"
                                    class="px-5 py-12 text-center text-gray-500"
                                >
                                    Data buku tidak ditemukan.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div
                    v-if="!pencarian && !Array.isArray(books) && books.links"
                    class="flex flex-wrap justify-center gap-2 border-t p-5"
                >
                    <Link
                        v-for="(link, index) in books.links"
                        :key="index"
                        :href="link.url || '#'"
                        preserve-scroll
                        class="rounded-md border px-3 py-2 text-sm"
                        :class="{
                            'border-blue-600 bg-blue-600 text-white': link.active,
                            'border-gray-300 bg-white text-gray-700': !link.active,
                            'pointer-events-none opacity-40': !link.url
                        }"
                        v-html="link.label"
                    />
                </div>
            </div>

            <!-- Footer -->
            <p class="mt-6 text-center text-sm text-gray-500">
                Sistem Informasi Perpustakaan
            </p>

        </div>
    </div>
</template>
