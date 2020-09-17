<template>
    <div id="header" class="p-6 box-border bg-purple-800 text-white w-full">
        <div class="container m-auto flex items-center justify-between">
            <application-logo/>
            <search-bar/>
            <div>
                <account/>
                <cart class="inline-block"/>
            </div>
        </div>
    </div>
</template>

<script>
    import ApplicationLogo from "./../Jetstream/ApplicationLogo"
    import SearchBar from "./../Ecommerce/SearchBar"
    import Cart from "./../Ecommerce/Cart"
    import Account from "./../Ecommerce/Account"

    export default{
        components: {
            ApplicationLogo,
            SearchBar,
            Cart,
            Account
        }
    }
</script>

<style>

</style>