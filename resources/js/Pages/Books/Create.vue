<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
    kode_buku: '',
    judul: '',
    pengarang: '',
    penerbit: '',
    tahun: new Date().getFullYear(),
    stok: 0,
})

function simpanBuku() {
    form.post(route('books.store'))
}
</script>

<template>
    <Head title="Tambah Buku" />

    <div class="min-h-screen bg-gray-100 px-4 py-8">
        <div class="mx-auto max-w-3xl rounded-xl bg-white p-6 shadow">
            <h1 class="mb-6 text-3xl font-bold">Tambah Buku</h1>

            <form @submit.prevent="simpanBuku" class="space-y-4">
                <div>
                    <label class="block font-medium">Kode Buku</label>
                    <input v-model="form.kode_buku" class="w-full rounded border p-2" required />
                    <p class="text-red-600">{{ form.errors.kode_buku }}</p>
                </div>

                <div>
                    <label class="block font-medium">Judul Buku</label>
                    <input v-model="form.judul" class="w-full rounded border p-2" required />
                    <p class="text-red-600">{{ form.errors.judul }}</p>
                </div>

                <div>
                    <label class="block font-medium">Pengarang</label>
                    <input v-model="form.pengarang" class="w-full rounded border p-2" required />
                    <p class="text-red-600">{{ form.errors.pengarang }}</p>
                </div>

                <div>
                    <label class="block font-medium">Penerbit</label>
                    <input v-model="form.penerbit" class="w-full rounded border p-2" required />
                    <p class="text-red-600">{{ form.errors.penerbit }}</p>
                </div>

                <div>
                    <label class="block font-medium">Tahun Terbit</label>
                    <input v-model.number="form.tahun" type="number" class="w-full rounded border p-2" required />
                    <p class="text-red-600">{{ form.errors.tahun }}</p>
                </div>

                <div>
                    <label class="block font-medium">Stok</label>
                    <input v-model.number="form.stok" type="number" min="0" class="w-full rounded border p-2" required />
                    <p class="text-red-600">{{ form.errors.stok }}</p>
                </div>

                <div class="flex gap-3">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="rounded bg-blue-600 px-5 py-2 text-white"
                    >
                        {{ form.processing ? 'Menyimpan...' : 'Simpan Buku' }}
                    </button>

                    <Link
                        :href="route('books.index')"
                        class="rounded bg-gray-300 px-5 py-2"
                    >
                        Kembali
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>
