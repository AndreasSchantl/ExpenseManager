<template>
    <div class="flex flex-col">
        <span v-if="label" class="text-sm">{{ label }}</span>
        <input 
            v-model="data"
            :type="type" 
            :id="id" 
            :name="name" 
            :placeholder="placeholder" 
            :title="placeholder" 
            :value="value" 
            :required="required" 
            :autofocus="autofocus" 
            :readonly="readonly" 
            :disabled="disabled" 
            :step="step"
            class="h-10 bg-white w-full border border-grey-100 px-4 focus:border-teal-500 focus:border-l focus:border-r focus:outline-none rounded appearance-none"
        >
    </div>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: "text"
            },
            id: {
                type: String
            },
            name: {
                type: String
            },
            label: {
                type: String
            },
            placeholder: {
                type: String
            },
            value: {
                type: [String, Number]
            },
            required: {
                type: Boolean,
                default: false
            },
            autofocus: {
                type: Boolean,
                default: false
            },
            readonly: {
                type: Boolean,
                default: false
            },
            disabled: {
                type: Boolean,
                default: false
            },
            step: {
                type: String
            },
        }, 
        data: function() {
            return {
                data: '',
            }
        },
        mounted: function() {
            if(this.value) {
                this.data = this.value;
            }
        },
        watch: {
            data(value) {
                this.$emit('input', value);
            },
            value(value) {
                this.data = value;
            }
        }
    }
</script>