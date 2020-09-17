<template>
    <div class="w-full grid grid-cols-1">
        <ecommerce-header/>
        <div id="content" class="mt-10 mb-10">
            <slot></slot>
        </div>
        <ecommerce-footer/>
    </div>
</template>

<script>
    import EcommerceFooter from "./../Ecommerce/Footer"
    import EcommerceHeader from "./../Ecommerce/Header"

    export default{
        props: {
            categories: {
                type: Array
            }
        },
        components: {
            EcommerceFooter,
            EcommerceHeader
        }
    }
</script>
<!--  Palette: purple: 500, _800_, 900 -->
<!--           blue:   300, _600_, 800 -->
<style>

</style>