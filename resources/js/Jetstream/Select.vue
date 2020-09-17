<template>
    <select
        class="form-input shadow-sm"
        @input="$emit('input', $event.target.value)"
        ref="select"
    >
        <option v-if="defaultOption" :value="defaultOption.value">
            {{defaultOption.name}}
        </option>
        <option v-for="(option,index) in options" :value="option.id" :key="index">
            {{option.name}}
        </option>
    </select>
</template>

<script>
    export default {
        props: {
            options: {
                type: Array,
                required: true
            },
            defaultOption: {
                type: [Object,Boolean],
                default: false
            }
        },

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

