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
                        <div class="mt-8 mb-8">
                            <inertia-link :href="`/posts/create`" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New Post</inertia-link>
                        </div>
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.success.message">
                            <div class="flex">
                                <div>
                                    <p class="text-sm">{{ $page.success.message }}</p>
                                </div>
                            </div>
                        </div>
                        <table class="shadow-lg bg-white w-full">
                            <tr>
                                <th class="bg-gray-200 border text-left px-8 py-4">Title</th>
                                <th class="bg-gray-200 border text-left px-8 py-4">Author</th>
                                <th class="bg-gray-200 border text-left px-8 py-4">Published At</th>
                            </tr>
                            <tr v-for="post in posts.data" :key="post.id">
                                <td class="border px-8 py-4">{{ post.title }}</td>
                                <td class="border px-8 py-4">{{ post.user.name }}</td>
                                <td class="border px-8 py-4">{{ post.published_at }}</td>
                            </tr>
                        </table>
                        <div class="mt-8">
                            <pagination :links="posts.links"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
    import Pagination from '../Shared/Pagination.vue'
    import AppLayout from './../../Layouts/AppLayout'

    export default {
        props: ['posts'],
        components: {
            AppLayout,
            Pagination
        },
    }
</script>