<template>
    <div>
        <button
            class="relative group items-center text-center cursor-pointer focus:outline-none"
        >
            <i class="fas fa-shopping-cart block text-xl"></i>
            <p>Your Cart</p>
            <div
                class=
                "
                    border border-solid border-black
                    bg-white text-black absolute w-84
                    group-focus:block group-hover:block
                    hidden p-3 shadow-lg rounded-md
                    right-0 cursor-default
                "
            >
                <div v-if="showItems">
                    <div class="w-full overflow-y-auto max-h-64">
                        <div
                            v-for="(item,index) in basket"
                            :key="index"
                            class="grid grid-cols-3 gap-3 items-center pb-3 pt-3"
                        >
                            <div class="text-left">
                                <img
                                    :src="item.image"
                                    :alt="item.name"
                                    class="inline h-10"
                                >
                            </div>
                            <div class="flex flex-col col-span-2">
                                <div class="font-bold text-left uppercase text-sm">
                                    {{item.name}}
                                </div>
                                <div class="flex items-center text-xs">
                                    <div class="font-thin mr-2">
                                        ${{numberFormat(item.price)}}
                                    </div>
                                    <div class="mr-2 font-thin">
                                        x
                                    </div>
                                    <jet-input
                                        @input="updateCart"
                                        v-model="item.quantity"
                                        class="w-6 text-xs p-1 mr-2"
                                    />
                                    <div class="whitespace-no-wrap font-bold">
                                        Total: $ {{numberFormat(item.quantity * item.price)}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-t font-bold text-left pt-3 uppercase">
                        Subtotal: $ {{numberFormat(orderTotal)}}
                    </div>
                    <div class="mt-3 -mr-3 -ml-3 -mb-3 grid grid-cols-2">
                        <inertia-link href="/checkout" class="w-full">
                            <button class="w-full p-3 bg-blue-600 focus:bg-blue-300 text-white">
                                Checkout
                            </button>
                        </inertia-link>
                        <inertia-link href="/basket" class="w-full">
                            <button class="p-3 bg-purple-800 text-white focus:bg-purple-500 w-full">
                                View cart
                            </button>
                        </inertia-link>
                    </div>
                </div>
                <div v-else>
                    Your cart is empty
                </div>
            </div>
        </button>
        <modal :show="showModal">
            <div class="p-4 text-black">
                <p class="text-2xl font-bold border-b pb-4 mb-4">
                    Product successfully added to basket:
                    <span
                        class="inline-block float-right cursor-pointer"
                        @click="closeModal"
                    >
                        <i class="fas fa-times"></i>
                    </span>
                </p>
                <p v-if="modalProduct" class="flex items-center">
                    <img
                        class="h-24"
                        :src="modalProduct.image"
                        :alt="modalProduct.name"
                    >
                    <span class="mx-6 text-lg uppercase">
                        {{modalProduct.name}}
                    </span>
                    <span class="text-lg">
                        1 x ${{modalProduct.price}}
                    </span>
                </p>
                <p class="mt-4 grid grid-cols-2 gap-4">
                    <inertia-link href="/basket" class="w-full">
                        <button class="w-full bg-blue-600 text-white p-4 text-lg rounded-md">
                            View cart
                        </button>
                    </inertia-link>
                    <button
                        class="bg-purple-800 text-white p-4 text-lg rounded-md"
                        @click="closeModal"
                    >
                        Continue shopping
                    </button>
                </p>
            </div>
        </modal>
        <portal-target v-if="showModal"  name="modal">
        </portal-target>
    </div>
</template>

<script>
    import JetInput from "./../Jetstream/Input"
    import Modal from "./../Jetstream/Modal"

    export default{
        data(){
            return {
                basket: {},
                showModal: false,
                modalProduct: null
            }
        },
        components: {
            JetInput,
            Modal
        },
        methods: {
            closeModal(){
                this.showModal = false
            },
            numberFormat(val){
                return new Intl.NumberFormat('en-US',
                    {
                        minimumFractionDigits: 2
                    }
                ).format(val)
            },
            async updateCart(){
                if(arguments[0]){
                    this.basket = arguments[0]
                }
                try {
                    const response = await axios.post("/cart", {items:this.basket})
                    this.basket = response.data
                }
                catch (e) {
                    alert("Update failed, try again later")
                }
            },
            addToCart(product){
                this.showModal = true
                this.modalProduct = {
                    image: product.image,
                    name: product.name,
                    price: product.price
                }
                for(let i = 0; i < this.basket.length; i++){
                    if(this.basket[i].product_id === product.id){
                        this.basket[i].quantity++
                        return
                    }
                }
                this.basket.push({
                    product_id: product.id,
                    quantity: 1
                })
                this.updateCart();
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
        async beforeCreate() {
            try {
                const response = await axios.get("/cart")
                this.basket = response.data
            }
            catch (e) {
                alert("Backend error")
            }
        },
        mounted(){
            this.eventHub.$on("addToCart",this.addToCart)
            this.eventHub.$on("updateCart",this.updateCart)
            this.$on("close",this.closeModal)
        }
    }
</script>