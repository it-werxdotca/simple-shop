<template>
    <store-layout>
        <div class="grid grid-cols-12 gap-4 container m-auto">
            <div class="col-span-7">
                <div class="grid grid-cols-1 gap-4">
                    <p class="text-3xl uppercase">Billing address</p>
                    <jet-input
                        placeholder="Name"
                        :value="order.billing_name"
                        @input="order.billing_name = $event"
                    />
                    <jet-input
                        placeholder="Email"
                        :value="order.billing_email"
                        @input="order.billing_email = $event"
                    />
                    <jet-input
                        placeholder="Address"
                        :value="order.billing_address"
                        @input="order.billing_address = $event"
                    />
                    <jet-input
                        placeholder="City"
                        :value="order.billing_city"
                        @input="order.billing_city = $event"
                    />
                    <jet-input
                        placeholder="Zip"
                        :value="order.billing_zip"
                        @input="order.billing_zip = $event"
                    />
                    <jet-input
                        placeholder="Phone"
                        :value="order.billing_phone"
                        @input="order.billing_phone = $event"
                    />
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <p class="text-3xl uppercase">Shipping address</p>
                    <p @click="differentAddress = !differentAddress">
                        <span
                            class="inline-flex items-center justify-center w-6 h-6 border text-white"
                            :class="{'bg-blue-600' : differentAddress}"
                        >
                            <i class="fas fa-check"></i>
                        </span>
                        Ship to different address?
                    </p>
                    <div
                        class="grid grid-cols-1 gap-4 h-0 transition-all duration-200 overflow-hidden"
                        :class="shippingClass"
                    >
                        <jet-input
                            placeholder="Name"
                            :value="order.shipping_name"
                            @input="order.shipping_name = $event"
                        />
                        <jet-input
                            placeholder="Email"
                            :value="order.shipping_email"
                            @input="order.shipping_email = $event"
                        />
                        <jet-input
                            placeholder="Address"
                            :value="order.shipping_address"
                            @input="order.shipping_address = $event"
                        />
                        <jet-input
                            placeholder="City"
                            :value="order.shipping_city"
                            @input="order.shipping_city = $event"
                        />
                        <jet-input
                            placeholder="Zip"
                            :value="order.shipping_zip"
                            @input="order.shipping_zip = $event"
                        />
                        <jet-input
                            placeholder="Phone"
                            :value="order.shipping_phone"
                            @input="order.shipping_phone = $event"
                        />
                    </div>
                </div>
            </div>
            <div class="col-span-5">
                <div class="w-full border p-4">
                    <p class="text-3xl uppercase text-center">your order</p>
                    <div class="grid grid-cols-2 font-bold">
                        <span>Product</span>
                        <span class="text-right">Total</span>
                    </div>
                    <div
                        class="grid grid-cols-2 my-4"
                        v-for="(item,index) in products"
                        :key="index"
                    >
                        <span>
                            1 x
                            <inertia-link
                                class="hover:text-blue-600 hover:font-bold"
                                :href="'/'+item.product.slug"
                            >
                                {{item.name}}
                            </inertia-link>
                        </span>
                        <span class="text-right">$ {{item.price}}</span>
                    </div>
                    <div class="grid grid-cols-2 my-4 font-bold">
                        <span>Total:</span>
                        <span class="text-right text-2xl text-blue-600">
                            $ {{orderTotal}}
                        </span>
                    </div>
                    <div @click="termsChecked = !termsChecked">
                        <span
                            class="inline-flex items-center justify-center w-6 h-6 border text-white mr-2"
                            :class="{'bg-blue-600' : termsChecked}"
                        >
                            <i class="fas fa-check"></i>
                        </span>
                        I've read and accept the terms & conditions
                    </div>
                    <inertia-link href="/checkout" method="post" :data="{order: order,differentAddress: differentAddress}">
                        <button class="w-full text-white bg-blue-600 rounded-md p-2 mt-4">
                            Place order
                        </button>
                    </inertia-link>
                </div>
            </div>
        </div>
    </store-layout>
</template>

<script>
    import StoreLayout from "./../Layouts/StoreLayout"
    import JetInput from "./../Jetstream/Input"

    export default{
        props: {
            products: Array,
        },
        data(){
            return {
                differentAddress: false,
                termsChecked: false,
                order: {
                    billing_name: "",
                    billing_email: "",
                    billing_phone: "",
                    billing_zip: "",
                    billing_city: "",
                    billing_address: "",
                    shipping_name: "",
                    shipping_email: "",
                    shipping_phone: "",
                    shipping_zip: "",
                    shipping_city: "",
                    shipping_address: "",
                }
            }
        },
        components: {
            StoreLayout,
            JetInput
        },
        methods: {
            log(){
                console.log(arguments)
            }
        },
        computed: {
            shippingClass(){
                if(this.differentAddress){
                    return "h-96"
                }
            },
            orderTotal(){
                return new Intl.NumberFormat('en-US',
                    {
                        minimumFractionDigits: 2
                    }
                ).format(
                    this.products.reduce(
                        (sum,{price}) => parseFloat(sum)+parseFloat(price)
                        , 0
                    )
                )
            }
        }
    }
</script>

<style>

</style>