<template>
    <div class="group relative">
        <div class="absolute text-xl w-full text-center -top-4 cursor-pointer">
            <div
                class="
                    rounded-full h-10 w-10 m-auto bg-white border
                    text-gray-600 flex items-center justify-center
                    hover:bg-red-600 hover:text-white hover:border-0
                    transition duration-200 ease-in-out
                "
                @click="scrollUp"
            >
                <i class="fas fa-chevron-up"></i>
            </div>
        </div>
        <div class="h-96 overflow-hidden">
            <div id="gallery-scroll" class="transition-all duration-300 ease-in-out">
                <div
                    v-for="(picture,index) in pictures"
                    :key="index"
                    class="border"
                >
                    <img
                        class="cursor-pointer"
                        :src="picture.url"
                        :alt="name"
                    >
                </div>
            </div>
        </div>
        <div class="absolute text-xl w-full text-center bottom-1 cursor-pointer">
            <div
                class="
                    rounded-full h-10 w-10 m-auto bg-white border
                    text-gray-600 flex items-center justify-center
                    hover:bg-red-600 hover:text-white hover:border-0
                    transition duration-200 ease-in-out
                "
                @click="scrollDown"
            >
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props: [
            "pictures",
            "name"
        ],
        methods:{
            scrollUp(){
                this.scroll(161)
            },
            scrollDown(){
                this.scroll(-161)
            },
            scroll(val){
                let current = parseInt(document.querySelector("#gallery-scroll").style.marginTop)
                if(isNaN(current)) current = 0
                current += val
                let images = this.pictures.length - 1
                if(current < (images * 161) * -1){
                    current = (images * 161) * -1
                }
                if(current > 0) current = 0
                document.querySelector("#gallery-scroll").style.marginTop =  `${current}px`
            }
        }
    }
</script>

<style>

</style>