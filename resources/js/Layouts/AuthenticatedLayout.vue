<script setup>
import { computed, ref } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import NavLink from '@/Components/NavLink.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'

const page = usePage()
const showingNavigationDropdown = ref(false)

const user = computed(() => page.props.auth?.user)

const isActive = (path) => page.url.startsWith(path)
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Navbar atas -->
        <nav class="fixed inset-x-0 top-0 z-30 h-16 border-b border-gray-200 bg-white">
            <div class="flex h-full items-center justify-between px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3">
                    <button
                        type="button"
                        class="rounded-md p-2 text-gray-600 hover:bg-gray-100 lg:hidden"
                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                    >
                        ☰
                    </button>

                    <Link href="/dashboard" class="flex items-center gap-3">
                        <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                        <span class="hidden font-semibold text-gray-800 sm:block">
                            Perpustakaan Mini
                        </span>
                    </Link>
                </div>

                <div class="flex items-center gap-4">
                    <Link
                        href="/dashboard"
                        class="hidden text-sm text-gray-600 hover:text-blue-600 sm:block"
                    >
                        Dashboard
                    </Link>

                    <div v-if="user" class="relative">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button class="flex items-center gap-2 rounded-md px-3 py-2 text-sm text-gray-600 hover:bg-gray-100">
                                    {{ user.name }}
                                    <span>⌄</span>
                                </button>
                            </template>

                            <template #content>
                                <DropdownLink href="/profile">
                                    Profil
                                </DropdownLink>

                                <DropdownLink href="/logout" method="post" as="button">
                                    Keluar
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar kiri -->
        <aside
            class="fixed bottom-0 left-0 top-16 z-20 hidden w-64 bg-slate-800 text-white lg:block"
        >
            <div class="px-6 py-5">
                <h2 class="mb-6 text-lg font-bold">
                    Perpustakaan Mini
                </h2>

                <nav class="space-y-2">
                    <Link
                        href="/dashboard"
                        class="block rounded-lg px-4 py-3 text-sm hover:bg-slate-700"
                        :class="{ 'bg-slate-700': isActive('/dashboard') }"
                    >
                        Dashboard
                    </Link>

                    <Link
                        href="/books"
                        class="block rounded-lg px-4 py-3 text-sm hover:bg-slate-700"
                        :class="{ 'bg-slate-700': isActive('/books') }"
                    >
                        Data Buku
                    </Link>

                    <Link
                        href="/profile"
                        class="block rounded-lg px-4 py-3 text-sm hover:bg-slate-700"
                        :class="{ 'bg-slate-700': isActive('/profile') }"
                    >
                        Profil
                    </Link>
                </nav>
            </div>
        </aside>

        <!-- Sidebar versi HP -->
        <div
            v-if="showingNavigationDropdown"
            class="fixed inset-x-0 bottom-0 top-16 z-20 overflow-y-auto bg-slate-800 p-4 text-white lg:hidden"
        >
            <nav class="space-y-2">
                <ResponsiveNavLink href="/dashboard">
                    Dashboard
                </ResponsiveNavLink>

                <ResponsiveNavLink href="/books">
                    Data Buku
                </ResponsiveNavLink>

                <ResponsiveNavLink href="/profile">
                    Profil
                </ResponsiveNavLink>
            </nav>
        </div>

        <!-- Konten halaman -->
        <main class="min-h-screen pt-16 lg:pl-64">
            <div class="p-4 sm:p-6 lg:p-8">
                <slot />
            </div>
        </main>
    </div>
</template>
