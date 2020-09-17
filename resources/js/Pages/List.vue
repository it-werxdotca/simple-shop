<template>
    <store-layout>
        <template>
            <div class="grid grid-cols-7 gap-2 container m-auto">
                <div class="col-span-2 mr-4">
                    <p class="text-2xl mb-4 uppercase">
                        Search
                    </p>
                    <jet-input class="w-full col-span-2" placeholder="Search by name"/>
                    <p class="text-2xl my-4 uppercase">
                        Categories
                    </p>
                    <button
                        v-for="(category,index) in categories"
                        :key="index"
                        class="text-left w-full focus:outline-none uppercase border-b py-2 cursor-pointer group"
                        @click.stop="filters.category = null"
                    >
                        <span class="block">
                            <span class="float-right text-gray-400 text-sm block">
                                <i class="fas fa-chevron-down"></i>
                            </span>
                            <span class="font-semibold">
                                {{category.name}}
                            </span>
                        </span>
                        <span
                            class="block transition-all duration-100 h-0 overflow-hidden"
                            :class="categoryClass(category)"
                        >
                            <span
                                v-for="(child,index) in category.children"
                                class="capitalize font-normal text-md block text-left"
                                :key="index"
                                @click.stop ="filters.category = child.name"
                            >
                                <span
                                    class="inline-flex items-center justify-center w-6 h-6 border text-white"
                                    :class="{'bg-blue-600' : filters.category === child.name}"
                                >
                                    <i class="fas fa-check"></i>
                                </span>
                                {{child.name}}
                            </span>
                        </span>
                    </button>
                    <p class="text-2xl my-4 uppercase">
                        Price
                    </p>
                    <div class="w-full grid grid-cols-2 gap-4">
                        <jet-input placeholder="Min"/>
                        <jet-input placeholder="Max"/>
                    </div>
                </div>
                <div class="col-span-5">
                    <pagination
                        :first="products.from"
                        :current="products.current"
                        :last="products.to"
                    />
                    <div class="grid grid-cols-3 gap-4">
                        <product-card
                            v-for="(product,index) in products.data"
                            :product="product"
                            :key="index"
                        />
                    </div>
                    <pagination/>
                </div>
            </div>
        </template>
    </store-layout>
</template>

<script>
    import StoreLayout from "./../Layouts/StoreLayout"
    import ProductCard from "./../Ecommerce/ProductCard"
    import JetInput from "./../Jetstream/Input"
    import Pagination from "../Ecommerce/Pagination";

    export default{
        data(){
            return {
                filters:{
                    category: null
                }
            }
        },
        methods: {
            categoryClass(category){
                let sizes = [6,12,18,24,30,36,42,48,54]
                let index = Math.min(
                    category.children.length-1
                    , sizes.length-1
                )
                let classes = `group-focus:h-${sizes[index]} focus:h-${sizes[index]}`
                for(let i=0;i<category.children.length;i++){
                    if(category.children[i].name === this.filters.category){
                        classes += ` h-${sizes[index]}`
                    }
                }
                return classes
            }
        },
        components: {
            Pagination,
            ProductCard,
            StoreLayout,
            JetInput
        },
        props: [
            "products",
            "categories"
        ]
    }
</script>

<style>

</style>