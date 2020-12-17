<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Posts
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200 pb-20">
                        <div class="mt-8 mb-8 text-2xl">
                            List of Posts
                        </div>
                        <table class="shadow-lg bg-white w-full">
                            <tr>
                                <th class="bg-gray-200 border text-left px-8 py-4">Title</th>
                                <th class="bg-gray-200 border text-left px-8 py-4">Author</th>
                                <th class="bg-gray-200 border text-left px-8 py-4">Published At</th>
                            </tr>
                            <tr v-for="post in posts" :key="post.id">
                                <td class="border px-8 py-4">{{ post.title }}</td>
                                <td class="border px-8 py-4">{{ post.user.name }}</td>
                                <td class="border px-8 py-4">{{ post.published_at }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
    import AppLayout from './../../Layouts/AppLayout'

    export default {
        props: ['posts'],
        components: {
            AppLayout
        },
    }
</script>