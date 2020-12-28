<template>
    <blog-layout>
        <article v-for="post in posts" :key="post.id" class="flex flex-col shadow my-4">
            <!-- Article Image -->
            <a href="#" class="hover:opacity-75" v-if="post.featured_image">
                <img v-bind:src="post.featured_image"/>
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
                <div class="text-blue-700 text-sm font-bold uppercase pb-4">
                    <template v-for="(category, index) in post.categories">
                        <template v-if="index > 0">, </template>
                        <inertia-link :href="`/category/${category.slug}`" :key="category.slug">{{ category.name }}</inertia-link>
                    </template>
                </div>

                <inertia-link :href="`/${post.slug}`" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ post.title }}</inertia-link>
                <p class="text-sm pb-3">
                    By  <inertia-link :href="`/user/${post.user.id}`" class="font-semibold hover:text-gray-800">{{ post.user.name }}</inertia-link>, Published on {{ post.published_at }}
                </p>
                <inertia-link :href="`/${post.slug}`" class="pb-6">{{ post.body }}</inertia-link>
                <inertia-link :href="`/${post.slug}`" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></inertia-link>
            </div>
        </article>
    </blog-layout>
</template>

<script>
    import BlogLayout from './../../Layouts/BlogLayout'

    export default {
        props: ['posts'],
        components: {
            BlogLayout,
        },
    }
</script>
