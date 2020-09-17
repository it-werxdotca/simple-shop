<template>
    <div class="grid grid-cols-1">
        <div class="flex items-center">
            <div class="text-3xl font-bold mr-8">
                {{formattedAverage}}
            </div>
            <div class="text-white text-stroke mx-1 text-2xl">
                <rating :stars="5" :value="parseFloat(reviewData.average)"></rating>
            </div>
        </div>
        <div class="flex">
            <div class="grid grid-cols-1 items-center">
                <rating :stars="5" :value="5"></rating>
                <rating :stars="5" :value="4"></rating>
                <rating :stars="5" :value="3"></rating>
                <rating :stars="5" :value="2"></rating>
                <rating :stars="5" :value="1"></rating>
            </div>
            <div class="flex-grow grid grid-cols-1 items-center ml-4">
                <div class="relative h-2">
                    <div class="absolute top-0 bg-gray-200 w-full h-2"></div>
                    <div
                        class="absolute top-0 bg-blue-600 h-2"
                        :style="`width: ${reviewData[5].percent}%` "
                    >

                    </div>
                </div>
                <div class="relative h-2">
                    <div class="absolute top-0 bg-gray-200 w-full h-2"></div>
                    <div
                        class="absolute top-0 bg-blue-600 h-2"
                        :style="`width: ${reviewData[4].percent}%` "
                    >

                    </div>
                </div>
                <div class="relative h-2">
                    <div class="absolute top-0 bg-gray-200 w-full h-2"></div>
                    <div
                        class="absolute top-0 bg-blue-600 h-2"
                        :style="`width: ${reviewData[3].percent}%` "
                    >

                    </div>
                </div>
                <div class="relative h-2">
                    <div class="absolute top-0 bg-gray-200 w-full h-2"></div>
                    <div
                        class="absolute top-0 bg-blue-600 h-2"
                        :style="`width: ${reviewData[2].percent}%` "
                    >

                    </div>
                </div>
                <div class="relative h-2">
                    <div class="absolute top-0 bg-gray-200 w-full h-2"></div>
                    <div
                        class="absolute top-0 bg-blue-600 h-2"
                        :style="`width: ${reviewData[1].percent}%` "
                    >

                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 items-center ml-4">
                <p class="text-gray-400">{{reviewData[5].count}}</p>
                <p class="text-gray-400">{{reviewData[4].count}}</p>
                <p class="text-gray-400">{{reviewData[3].count}}</p>
                <p class="text-gray-400">{{reviewData[2].count}}</p>
                <p class="text-gray-400">{{reviewData[1].count}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    import Rating from "./Rating";
    export default{
        components: {Rating},
        props: [
            "reviewData"
        ],
        computed: {
            formattedAverage(){
                return Math.floor(this.reviewData.average * 10) / 10
            }
        }
    }
</script>

<style>

</style>