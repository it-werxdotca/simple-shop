<template>
    <div class="border-2 hover:border-blue-600 w-72 p-3 grid grid-cols-1 items-center">
        <inertia-link :href="'/'+product.slug" class="text-center">
            <img
                class="p-4 max-w-full" :alt="product.name"
                :src="product.image"
            />
        </inertia-link>
        <inertia-link :href="'/'+product.slug" class="uppercase font-bold text-center">
            {{product.name}}
        </inertia-link>
        <div class="text-blue-600 font-bold text-center mt-4 text-xl">
            $ {{product.price}}
        </div>
        <div class="text-center my-4 tabs">
            <rating
                class="inline-block p-2 border rounded-full bg-white"
                :value="Math.round(product.rating)"
                :stars="5"
            />
        </div>
        <button
            @click="addToCart"
            class="text-white bg-blue-600 rounded-full py-2 px-4 w-full self-end"
        >
            Add to cart
        </button>
    </div>
</template>

<script>
    import Rating from "./Rating";
    export default{
        components: {Rating},
        props: ["product"],
        methods: {
            addToCart(){
                this.eventHub.$emit('addToCart', this.product)
            }
        }
    }
</script>

<style scoped lang="scss">
    .tabs {
        position: relative;
        &:after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            height: 1px;
            background-color: #E4E7ED;
            z-index: -1;
        }
    }
</style>