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
                            {{ (post) ? 'Edit' : 'Create New' }} Post
                        </div>
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.success.message">
                            <div class="flex">
                                <div>
                                <p class="text-sm">{{ $page.success.message }}</p>
                                </div>
                            </div>
                        </div>

                        <form>
                            <div class="bg-white">
                                <div class="">
                                    <div class="mb-4">
                                        <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Title" v-model="form.title">
                                        <div v-if="$page.errors.title" class="text-red-500">{{ $page.errors.title[0] }}</div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Body:</label>
                                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" placeholder="Enter Body" v-model="form.body" rows="10"></textarea>
                                        <div v-if="$page.errors.body" class="text-red-500">{{ $page.errors.body[0] }}</div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="categoryIds" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                                        <select multiple="true" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="categoryIds" v-model="form.category_ids">
                                            <option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{ category.name }}</option>
                                        </select>
                                        <div v-if="$page.errors.category_ids" class="text-red-500">{{ $page.errors.category_ids[0] }}</div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Tags:</label>
                                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Tags separate by Comma" v-model="form.tags_input">
                                        <div v-if="$page.errors.tags" class="text-red-500">{{ $page.errors.tags[0] }}</div>
                                    </div>
                                    <div class="mb-4">
                                        <input type="file" class="shadow appearance-none border rounded w-full" @change="onImageChange">
                                    </div>
                                    <div class="mb-4">
                                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" v-model="form.status">
                                            <option v-for="(status, status_key) in statuses" :key="status_key" v-bind:value="status_key">{{ status }}</option>
                                        </select>
                                        <div v-if="$page.errors.status" class="text-red-500">{{ $page.errors.status[0] }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                    <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="!editMode" @click="save(form)">
                                        Save
                                    </button>
                                </span>
                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                    <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="editMode" @click="update(form)">
                                        Update
                                    </button>
                                </span>
                                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                    <inertia-link :href="`/posts`" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                        Cancel
                                    </inertia-link>
                                </span>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
    import AppLayout from './../../Layouts/AppLayout'

    export default {
        props: ['categories', 'post', 'statuses'],
        components: {
            AppLayout
        },
        data() {
            if (this.post) {
                return {
                    editMode: true,
                    form: this.post,
                }
            }

            return {
                editMode: false,
                form: {
                    title: null,
                    body: null,
                    category_ids: [],
                    tags_input: null,
                    image: null,
                    status: null,
                }
            }
        },
        methods: {
            reset() {
                this.form = {
                    title: null,
                    body: null,
                    category_ids: [],
                    tags_input: null,
                }
            },
            save(form) {
                var data = new FormData()

                data.append('title', form.title)
                data.append('body', form.body)

                for (var i = 0; i < form.category_ids.length; i++) {
                    data.append('category_ids[]', form.category_ids[i])
                }

                data.append('tags_input', form.tags_input)
                data.append('image', form.image)
                data.append('status', form.status)

                this.$inertia.post('/posts', data)
                this.reset()
                this.editMode = false
            },
            update(form) {
                var data = new FormData()

                data.append('_method', 'put')
                data.append('title', form.title)
                data.append('body', form.body)

                for (var i = 0; i < form.category_ids.length; i++) {
                    data.append('category_ids[]', form.category_ids[i])
                }

                data.append('tags_input', form.tags_input)
                data.append('image', form.image)
                data.append('status', form.status)
    
                this.$inertia.post('/posts/' + form.id, data);
                this.editMode = true;
            },
            onImageChange(e) {
                e.preventDefault();
                this.form.image = e.target.files[0];
            }
        }
    }
</script>