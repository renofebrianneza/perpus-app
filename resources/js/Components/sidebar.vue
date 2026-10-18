<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
<div class="flek-1">
  <aside class="w-64 bg-gray-800 text-white h-screen p-4">
    <h2 class="text-lg font-bold mb-4">Perpustakaan Mini</h2>
    <nav class="space-y-2">
      <Link href="/dashboard" class="block hover:text-gray-300">Dashboard</Link>
      <Link href="/" class="block hover:text-gray-300">Beranda</Link>
    </nav>
  </aside>
        <header
      class="bg-white shadow"
      v-if="$slots.header">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <slot name="header" />
        </div>
        </header>
        <!-- Page Content -->
        <main>
        <slot />
        </main>

  </div>
</template>