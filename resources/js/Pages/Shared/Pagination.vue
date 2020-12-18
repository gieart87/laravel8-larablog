<template>
    <div class="flex items-center" v-if="showPagination">
        <span v-for="(link, key) in links" :key="key">
            <inertia-link class="border-t border-b border-l border-brand-light px-3 py-2 hover:bg-brand-light text-brand-dark no-underline" v-bind:class="borderRightClass(link)" :href="link.url" v-if="link.url && link.active == false">{{ link.label }}</inertia-link>
            <span class="border-t border-b border-l border-brand-light px-3 py-2 bg-gray-200 no-underline" v-bind:class="borderRightClass(link)" v-else>{{ link.label }}</span>
        </span>
    </div>
</template>
<script>
    export default {
        props: {
            links: Array,
        },
        computed: {
            showPagination() {
                return this.links.length > 3
            }
        },
        methods: {
            borderRightClass(link) {
                return (link.label == 'Next') ? 'border-r' : ''
            }
        }
    }
</script>