<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
    book: {
        type: Object,
        required: true,
    },
})

const form = useForm({
    kode_buku: props.book.kode_buku ?? '',
    judul: props.book.judul ?? '',
    pengarang: props.book.pengarang ?? '',
    penerbit: props.book.penerbit ?? '',
    tahun: props.book.tahun ?? new Date().getFullYear(),
    stok: props.book.stok ?? 0,
})

function perbaruiBuku() {
    form.put(route('books.update', props.book.id))
}
</script>

<template>
    <Head title="Edit Buku" />

    <div class="min-h-screen bg-gray-100 px-4 py-8">
        <div class="mx-auto max-w-3xl rounded-xl bg-white p-6 shadow">
            <h1 class="mb-2 text-3xl font-bold text-gray-800">
                Edit Buku
            </h1>

            <p class="mb-6 text-gray-600">
                Perbarui data buku perpustakaan.
            </p>

            <form @submit.prevent="perbaruiBuku" class="space-y-4">
                <div>
                    <label class="mb-1 block font-medium">Kode Buku</label>
                    <input v-model="form.kode_buku" type="text"
                        class="w-full rounded-lg border p-3" required />
                    <p v-if="form.errors.kode_buku" class="text-sm text-red-600">
                        {{ form.errors.kode_buku }}
                    </p>
                </div>

                <div>
                    <label class="mb-1 block font-medium">Judul Buku</label>
                    <input v-model="form.judul" type="text"
                        class="w-full rounded-lg border p-3" required />
                    <p v-if="form.errors.judul" class="text-sm text-red-600">
                        {{ form.errors.judul }}
                    </p>
                </div>

                <div>
                    <label class="mb-1 block font-medium">Pengarang</label>
                    <input v-model="form.pengarang" type="text"
                        class="w-full rounded-lg border p-3" required />
                    <p v-if="form.errors.pengarang" class="text-sm text-red-600">
                        {{ form.errors.pengarang }}
                    </p>
                </div>

                <div>
                    <label class="mb-1 block font-medium">Penerbit</label>
                    <input v-model="form.penerbit" type="text"
                        class="w-full rounded-lg border p-3" required />
                    <p v-if="form.errors.penerbit" class="text-sm text-red-600">
                        {{ form.errors.penerbit }}
                    </p>
                </div>

                <div>
                    <label class="mb-1 block font-medium">Tahun Terbit</label>
                    <input v-model.number="form.tahun" type="number"
                        min="1000" max="2100"
                        class="w-full rounded-lg border p-3" required />
                    <p v-if="form.errors.tahun" class="text-sm text-red-600">
                        {{ form.errors.tahun }}
                    </p>
                </div>

                <div>
                    <label class="mb-1 block font-medium">Stok</label>
                    <input v-model.number="form.stok" type="number" min="0"
                        class="w-full rounded-lg border p-3" required />
                    <p v-if="form.errors.stok" class="text-sm text-red-600">
                        {{ form.errors.stok }}
                    </p>
                </div>

                <div class="flex flex-wrap gap-3 pt-3">
                    <button type="submit" :disabled="form.processing"
                        class="rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700 disabled:opacity-50">
                        {{ form.processing ? 'Menyimpan...' : 'Simpan Perubahan' }}
                    </button>

                    <Link :href="route('books.index')"
                        class="rounded-lg bg-gray-200 px-5 py-3 font-semibold text-gray-800 hover:bg-gray-300">
                        Kembali
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>
