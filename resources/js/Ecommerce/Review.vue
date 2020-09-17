<template>
    <div class="grid grid-cols-7 mb-5 items-center">
        <div>
            <p class="font-bold">{{review.name}}</p>
            <p>
                <rating :stars="5" :value="parseFloat(review.rating)"></rating>
            </p>
        </div>
        <div class="col-span-6">
            {{review.review}}
        </div>
    </div>
</template>

<script>
    import Rating from "./Rating";

    export default{
        components: {Rating},
        props: [
            "review"
        ]
    }
</script>

<style>

</style>