<template>
    <store-layout>
        <template>
            <div class="container m-auto">
                <div class="grid grid-cols-12">
                    <div class="col-span-2 grid grid-col gap-2">
                        <product-gallery
                            :pictures="product.pictures"
                            :name="product.name"
                        />
                    </div>
                    <div class="col-span-5">
                         <img
                             class="inline-block p-6"
                             :src="product.image"
                             :alt="product.name"
                         >
                    </div>
                    <div class="col-span-5">
                        <h1 class="font-bold text-3xl uppercase mb-3">
                            {{product.name}}
                        </h1>
                        <p class="text-blue-600 font-bold text-2xl">
                            <span>$ {{product.price}}</span>
                            <span class="ml-4 text-base"> {{product.status}} </span>
                        </p>
                        <p
                            class="mt-3"
                            v-html="product.description.description"
                        ></p>
                        <p class="flex items-center">
                            <span>
                                QTY: <jet-input :value="1" class="w-12 text-center"/>
                            </span>
                            <button
                                @click="addToCart(product)"
                                class="text-white bg-blue-600 rounded-full py-2 px-8 m-3"
                            >
                                Add to cart
                            </button>
                        </p>
                    </div>
                </div>
                <ul class="tabs relative w-full text-center">
                    <li class="inline-block bg-white px-2 mx-3 text-lg">
                        <a
                            class="tab focus:text-blue-600 font-bold description outline-none"
                            href="#"
                            @click.prevent="active = 'description'"
                        >
                            Description
                        </a>
                    </li>
                    <li class="inline-block bg-white px-2 mx-3 text-lg">
                        <a
                            class="tab focus:text-blue-600 font-bold details outline-none"
                            href="#"
                            @click.prevent="active = 'details'"
                        >
                            Details
                        </a>
                    </li>
                    <li class="inline-block bg-white px-2 mx-3 text-lg">
                        <a
                            class="tab focus:text-blue-600 font-bold reviews outline-none"
                            href="#"
                            @click.prevent="active = 'reviews'"
                        >
                            Reviews
                        </a>
                    </li>
                </ul>
                <div v-if="active === 'description'">
                    <div class="pt-10">
                        <h3 class="text-2xl font-bold mb-4">Description:</h3>
                        {{product.description.description}}
                    </div>
                </div>
                <div v-if="active === 'details'">
                    <div class="pt-10">
                        <h3 class="text-2xl font-bold mb-4">Details:</h3>
                        {{product.description.description}}
                    </div>
                </div>
                <div v-if="active === 'reviews'">
                    <div class="grid grid-cols-12 gap-3 pt-10">
                        <div class="col-span-3">
                            <rating-overview
                                :reviewData="reviewData"
                            />
                        </div>
                        <div class="col-span-9 pl-4">
                            <review
                                v-for="(review,index) in product.reviews"
                                :key="index"
                                :review="review"
                            />
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="text-4xl font-bold w-full text-center">
                        Related products
                    </h2>
                    <div class="grid grid-cols-4 gap-2 overflow-scroll lg:overflow-auto xl:overflow-auto">
                        <product-card
                            v-for="(product,index) in related"
                            :key="index"
                            :product="product"
                        />
                    </div>
                </div>
            </div>
        </template>
    </store-layout>
</template>

<script>
    import StoreLayout from "./../Layouts/StoreLayout"
    import ProductCard from "./../Ecommerce/ProductCard"
    import JetInput from "./../Jetstream/Input"
    import ProductGallery from "../Ecommerce/ProductGallery";
    import RatingOverview from "../Ecommerce/RatingOverview";
    import Review from "../Ecommerce/Review";

    export default{
        components: {
            Review,
            RatingOverview,
            ProductGallery,
            StoreLayout,
            ProductCard,
            JetInput
        },
        props: [
            "product",
            "related",
            "reviewData"
        ],
        methods: {
            addToCart(product){
                this.eventHub.$emit('addToCart', product)
            }
        },
        data(){
            return {
                active: "description"
            }
        },
        mounted(){
            this.$nextTick(function () {
                document.querySelector(".description").focus()
            })
        }
    }
</script>

<style lang="scss" scoped>
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

    .tabs:after{
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: 50%;
        height: 1px;
        background-color: #E4E7ED;
        z-index: -1;
    }

    .tab {
        &:hover,&:active,&:focus{
            &:after{
                width: 100%;
            }
        }

        &:after{
            content: "";
            display: block;
            width: 0;
            height: 2px;
            background-color: #1e429f;
            transition: 0.2s all;
        }
    }
</style>