<template>
    <div class="w-1/4 m-auto mb-4 grid grid-cols-5 gap-2 text-sm text-gray-500">
        <pagination-button
            v-for="(item,index) of templateItems"
            :key="index"
        >
            <i v-if="item === 'FirstPageLink'" class="fas fa-angle-double-left"></i>
            <i v-else-if="item === 'PrevPageLink'" class="fas fa-angle-left"></i>
            <i v-else-if="item === 'NextPageLink'" class="fas fa-angle-right"></i>
            <i v-else-if="item === 'LastPageLink'" class="fas fa-angle-double-right"></i>
            <span v-else>
                {{current}}
            </span>
        </pagination-button>
    </div>
</template>

<script>
    import PaginationButton from "./PaginationButton"

    export default{
        props: {
            first: {
                type: Number,
                default: 1,
            },
            last: {
                type: Number,
                default: 1,
            },
            current: {
                type: Number,
                default: 1,
            },
            template: {
                type: String,
                default: 'FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink'
            },
        },
        computed: {
            templateItems() {
                let keys = [];
                this.template.split(' ').map((value) => {
                    keys.push(value.trim());
                })
                return keys;
            }
        },

        components: {
            PaginationButton
        }
    }
</script>

<style>

</style>