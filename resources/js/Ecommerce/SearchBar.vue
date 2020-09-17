<template>
    <span class="flex-grow lg:max-w-lg md:max-w-md sm:max-w-sm hidden md:inline-flex lg:inline-flex sm:inline-flex ">
        <jet-select
            class="text-black rounded-none rounded-tl-lg rounded-bl-lg"
            :options="$page.categories"
            :default-option="{name: 'All categories', value: 'all'}"
        />
        <jet-input
            class="rounded-none text-black flex-grow bg-gray-100 focus:bg-white"
            placeholder="Search"
        />

        <inertia-link href="/list">
            <button class="
                bg-blue-600 text-white cursor-pointer p-2
                border border-solid border-blue-600
                rounded-tr-lg rounded-br-lg
            ">
                Search
            </button>
        </inertia-link>
    </span>
</template>

<script>
    import JetInput from "./../Jetstream/Input"
    import JetSelect from "./../Jetstream/Select"

    export default{
        components: {
            JetInput,JetSelect
        }
    }
</script>

<style>

</style>