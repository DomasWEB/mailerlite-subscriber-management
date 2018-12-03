<template>
    <div>
        <card>
            <template slot="title">Field</template>

            <validation-error-list :errors="errors"></validation-error-list>

            <b-loading :active.sync="isLoading" :is-full-page="false"></b-loading>

            <b-field :message="fieldMessage('title')" :type="fieldType('title')" label="Title">
                <b-input v-model="model.title"></b-input>
            </b-field>

            <b-field label="Type">
                <b-input disabled v-model="model.type"></b-input>
            </b-field>

            <button @click="update" class="button is-success mt-3">
                Update
            </button>
        </card>


    </div>
</template>

<script>
    export default {
        name: "FieldEdit",
        data() {
            return {
                isLoading: true,
                id: 0,
                model: {},
                errors: []
            }
        },
        created() {
            this.id = this.$route.params.field;
            this.load();
        },
        methods: {
            load() {
                ApiClient.get('fields/' + this.id)
                    .then(response => {
                        this.model = response.data.data;
                        this.isLoading = false;
                    });
            },
            update() {
                this.isLoading = true;
                ApiClient.put('fields/' + this.id, this.model)
                    .then(() => {
                        this.$router.push({'name': 'fields'});
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        this.isLoading = false;
                    });
            },
            fieldTitle(field) {
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
        }
    }
</script>

<style scoped>
    h2 {
        color: red;
        font-weight: bold;
    }
</style>