<template>
    <div class="flex flex-col">
        <span v-if="label" class="text-sm">{{ label }}</span>
        <textarea 
            v-model="data"
            :type="type" 
            :id="id" 
            :name="name" 
            :placeholder="placeholder" 
            :title="placeholder" 
            :required="required" 
            :autofocus="autofocus" 
            :readonly="readonly" 
            :disabled="disabled" 
            class="h-16 bg-white w-full border border-grey-100 px-4 py-2 focus:border-teal-500 focus:border-l focus:border-r focus:outline-none rounded appearance-none">
        </textarea>
        <small v-if="max" class="text-right">{{ max - data.length }} {{ __('app.exp_char_count_remaining') }}</small>
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
            max: {
                type: Number
            },
        }, 
        data: function() {
            return {
                data: '',
                translations: []
            }
        },
        methods: {
            __: function(key) {
                for(let i of this.translations) {
                    if(i.key == key) {
                        return i.value;
                    }
                }

                axios.get('/api/getTranslation/' + key)
                    .then(response => {
                        this.translations.push({
                            'key': key,
                            'value': response.data
                        });
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
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