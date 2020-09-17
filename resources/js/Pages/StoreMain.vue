<template>
    <store-layout>
        <template>
            <div class="container m-auto grid grid-cols-4 gap-4" v-if="products">
                <product-card
                    v-for="(product,index) in products.data"
                    :key="index"
                    :product="product"
                />
            </div>
        </template>
    </store-layout>
</template>

<script>
    import StoreLayout from "./../Layouts/StoreLayout"
    import ProductCard from "./../Ecommerce/ProductCard"

    export default{
        components: {
            StoreLayout,
            ProductCard
        },
        data(){
            return {
                products: null,
            }
        },
        async beforeCreate() {
            this.products = await axios.get("/api/list")
        }
    }
</script>

<style>

</style>