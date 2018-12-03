<template>
    <div>
        <card>
            <template slot="title">Create a subscriber</template>

            <b-loading :active.sync="isLoading" :is-full-page="false"></b-loading>

            <validation-error-list :errors="errors"></validation-error-list>

            <b-field :message="fieldMessage('name')" :type="fieldType('name')" label="Name">
                <b-input v-model="model.name"></b-input>
            </b-field>

            <b-field :message="fieldMessage('email')" :type="fieldType('email')" label="E-mail">
                <b-input type="email" v-model="model.email"></b-input>
            </b-field>

            <card style="margin-bottom:15px;">
                <template slot="title">Fields</template>

                <b-field label="Field">
                    <b-select expanded v-model="selected_field">
                        <option value=""></option>
                        <option :value="field.key"
                                v-for="field in fields">
                            {{ field.title }} ({{ field.type }})
                        </option>
                    </b-select>
                </b-field>

                <button :disabled="this.selected_field == ''" @click="addField" class="button is-info">
                    Add field
                </button>

                <hr>


                <b-field :key="field.key" :label="fieldTitle(field)" v-for="field in model.fields">
                    <b-switch false-value="0"
                              true-value="1"
                              v-if="field.type == 'boolean'"
                              v-model="field.value"></b-switch>
                    <b-input type="number" v-else-if="field.type == 'number'" v-model="field.value"></b-input>
                    <datepicker format="yyyy-MM-dd" input-class="input" v-else-if="field.type == 'date'"
                                v-model="field.value"></datepicker>

                    <b-input v-else v-model="field.value"></b-input>
                </b-field>
            </card>

            <button @click="create" class="button is-success mt-3">
                Create
            </button>
        </card>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import ValidationErrorList from "./ValidationErrorList";

    export default {
        name: "SubscriberCreate",
        components: {
            ValidationErrorList,
            Datepicker
        },
        data() {
            return {
                isLoading: true,
                id: 0,
                model: {
                    name: '',
                    email: '',
                    fields: []
                },
                errors: {},
                fields: {},
                selected_field: ''
            }
        },
        created() {
            this.loadFields();
        },
        methods: {
            loadFields() {
                ApiClient.get('fields/')
                    .then(response => {
                        this.fields = response.data.data;
                        this.isLoading = false;
                    });
            },
            create() {
                this.isLoading = true;
                ApiClient.post('subscribers', this.model)
                    .then(() => {
                        this.$router.push({'name': 'subscribers'});
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        this.isLoading = false;
                    });
            },
            fieldTitle(field) {
                console.log(field);
                return field.title + ' (' + field.type + ')';
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
            addField() {
                let index = -1;
                let fieldModel = {};

                this.fields.forEach((field, key) => {
                    if (field.key == this.selected_field) {
                        index = key;
                        fieldModel = field;
                    }
                });

                this.model.fields.push({
                    key: this.selected_field,
                    value: '',
                    type: fieldModel.type,
                    title: fieldModel.title
                });

                this.fields.splice(index, 1);
                this.selected_field = '';
            }
        }
    }
</script>

<style scoped>

</style>