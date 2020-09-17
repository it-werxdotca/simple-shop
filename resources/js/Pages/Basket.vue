<template>
    <store-layout>
        <div class="container m-auto">
            <div v-if="showItems">
                <div class="grid grid-cols-12 items-center">
                    <div class="col-span-5 text-xl uppercase text-black font-bold">
                        Product
                    </div>
                    <div class="col-span-2 text-xl uppercase text-black font-bold">
                        price
                    </div>
                    <div class="col-span-2 text-xl uppercase text-black font-bold">
                        quantity
                    </div>
                    <div class="col-span-2 text-xl uppercase text-black font-bold">
                        total
                    </div>
                    <div>

                    </div>
                </div>
                <div
                    class="grid grid-cols-12 items-center border-b py-4"
                    v-for="(item,index) in basket"
                    :key="index"
                >
                    <div class="col-span-5 text-lg flex items-center">
                        <img :src="item.image" :alt="item.name" class="h-24 mr-4">
                        <span>{{item.name}}</span>
                    </div>
                    <div class="col-span-2 text-lg">
                        $ {{numberFormat(item.price)}}
                    </div>
                    <div class="col-span-2 text-lg ml-8">
                        <jet-input
                            @input="updateCart"
                            v-model="item.quantity"
                            class="w-12"
                        />
                    </div>
                    <div class="col-span-2 text-lg">
                        $ {{numberFormat(item.price * item.quantity)}}
                    </div>
                    <div>
                        <span
                            class="flex items-center justify-around block rounded-full bg-gray-300 w-10 h-10 cursor-pointer"
                            @click="deleteProduct(item)"
                        >
                            <i class="fas fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div v-else class="text-2xl font-bold">
                Your cart is empty
            </div>
            <div class="grid grid-cols-3 mt-6">
                <div class="col-span-2">
                    <inertia-link href="/list">
                        <div class="bg-purple-800 text-white inline-block p-4 text-xl rounded-md">
                            Continue shopping
                        </div>
                    </inertia-link>
                </div>
                <div v-if="showItems" class="text-right">
                    <inertia-link href="/checkout">
                        <div class="bg-blue-600 text-white inline-block p-4 text-xl rounded-md">
                            Go to checkout
                        </div>
                    </inertia-link>
                </div>
            </div>
        </div>
    </store-layout>
</template>

<script>
    import StoreLayout from "./../Layouts/StoreLayout";
    import JetInput from "./../Jetstream/Input"

    export default{
        data(){
            return {
                basket: {}
            }
        },
        methods: {
            async deleteProduct(item){
                for(let i = 0; i < this.basket.length; i++){
                    if(this.basket[i].product_id === item.product_id){
                        this.basket[i].quantity = 0
                    }
                }
                await this.updateCart()
                this.eventHub.$emit('updateCart',this.basket)
            },
            numberFormat(val){
                return new Intl.NumberFormat('en-US',
                    {
                        minimumFractionDigits: 2
                    }
                ).format(val)
            },
            async updateCart(){
                try {
                    const response = await axios.post("/cart", {items:this.basket})
                    this.basket = response.data
                }
                catch (e) {
                    alert("Update failed, try again later")
                }
            }
        },
        computed: {
            orderTotal(){
                if(typeof(this.basket.reduce) === "function"){
                    return this.basket.reduce(
                        (total, item) => total + (item.quantity * item.price)
                        , 0
                    )
                }
                else{
                    return 0
                }
            },
            showItems(){
                return 'length' in this.basket && this.basket.length > 0
            }
        },
        components: {
            StoreLayout,
            JetInput
        },
        async beforeCreate() {
            try {
                const response = await axios.get("/cart")
                this.basket = response.data
            }
            catch (e) {
                alert("Backend error")
            }
        }
    }
</script>

<style>

</style>