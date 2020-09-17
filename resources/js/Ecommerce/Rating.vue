<template>
    <div>
        <span
            :key="i"
            v-for="i in stars"
        >
            <i
                class="fas fa-star text-stroke text-transparent"
                :class="{'text-blue-600 text-no-stroke' : value >= i}"
            ></i>
        </span>
    </div>
</template>

<script>
    export default {
        props: {
            value: {
                type: Number,
                default: null
            },
            stars: {
                type: Number,
                default: 5
            }
        }
    }
</script>

<style scoped>
    .text-stroke{
        text-shadow:
            -1px -1px 0 #cbd5e0,
            1px -1px 0 #cbd5e0,
            -1px 1px 0 #cbd5e0,
            1px 1px 0 #cbd5e0;
    }

    .text-no-stroke{
        text-shadow: none;
    }
</style>