<template>
    <div>
        <card>
            <template slot="title">Create a field</template>

            <b-loading :active.sync="isLoading" :is-full-page="false"></b-loading>

            <validation-error-list :errors="errors"></validation-error-list>

            <b-field :message="fieldMessage('title')" :type="fieldType('title')" label="Title">
                <b-input v-model="model.title"></b-input>
            </b-field>

            <b-field :message="fieldMessage('type')" :type="fieldType('type')" label="Type">
                <b-select expanded placeholder="Please select a type" v-model="model.type">
                    <option value=""></option>
                    <option
                            :key="option"
                            :value="key"
                            v-for="(option, key) in data">
                        {{ option }}
                    </option>
                </b-select>
            </b-field>

            <button @click="create" class="button is-success mt-3">
                Create
            </button>
        </card>
    </div>
</template>

<script>
    export default {
        name: "FieldCreate",
        data() {
            return {
                isLoading: false,
                id: 0,
                model: {
                    title: '',
                    type: 'string'
                },
                errors: {},
                data: {
                    string: 'String',
                    boolean: 'Boolean',
                    date: 'Date',
                    number: 'Number',
                }
            }
        },

        methods: {
            create() {
                this.isLoading = true;
                ApiClient.post('fields', this.model)
                    .then(() => {
                        this.$router.push({'name': 'fields'});
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        this.isLoading = false;
                    });
            },
            fieldType(name) {
                if (typeof this.errors[name] == 'object') {
                    return 'is-danger';
                }

                return '';
            },
            fieldMessage(name) {
                if (typeof this.errors[name] == 'object') {
                    return this.errors[name].toString();
                }

                return '';
            },
        }
    }
</script>

<style scoped>

</style>