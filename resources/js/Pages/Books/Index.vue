<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    books: Object,
    search: String,
});

const keyword = ref(props.search || '');

// Dijalankan saat menekan Enter di kotak pencarian
function cari() {
    router.get('/books', { search: keyword.value });
}

// Dijalankan saat tombol Hapus diklik
function hapus(id) {
    if (confirm('Yakin ingin menghapus buku ini?')) {
        router.delete(route('books.destroy', id));
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <h1>Data Buku</h1>

        <!-- Flash message sukses -->
        <div v-if="$page.props.flash.success" style="color: green;">
            {{ $page.props.flash.success }}
        </div>

        <!-- Flash message error (LATIHAN 1) -->
        <div v-if="$page.props.flash.error" style="color: red;">
            {{ $page.props.flash.error }}
        </div>

        <Link href="/books/create">+ Tambah Buku</Link>

        <input
            v-model="keyword"
            @keyup.enter="cari"
            type="text"
            placeholder="Cari judul, pengarang, atau kode..."
        >

        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="book in books.data" :key="book.id">
                    <td>{{ book.kode_buku }}</td>
                    <td>{{ book.judul }}</td>
                    <td>{{ book.pengarang }}</td>
                    <td>{{ book.stok }}</td>
                    <td>
                        <Link :href="`/books/${book.id}/edit`">Edit</Link>
                        <button @click="hapus(book.id)">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </AuthenticatedLayout>
</template>