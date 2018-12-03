<template>
    <div>
        <card>
            <template slot="title">Subscriber</template>

            <b-loading :active.sync="isLoading" :is-full-page="false"></b-loading>

            <b-field label="Name">
                <b-input v-model="model.name"></b-input>
            </b-field>

            <b-field label="E-mail">
                <b-input disabled v-model="model.email"></b-input>
            </b-field>

            <card style="margin-bottom:15px;">
                <template slot="title">Fields</template>

                <b-field :key="field.id" :label="fieldTitle(field)" v-for="field in model.fields">
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

            <button @click="update" class="button is-success mt-3">
                Update
            </button>
        </card>


    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    export default {
        name: "SubscriberEdit",
        components: {
            Datepicker
        },
        data() {
            return {
                isLoading: true,
                id: 0,
                model: {}
            }
        },
        created() {
            this.id = this.$route.params.subscriber;
            this.load();
        },
        methods: {
            load() {
                ApiClient.get('subscribers/' + this.id)
                    .then(response => {
                        this.model = response.data.data;
                        this.isLoading = false;
                    });
            },
            update() {
                this.isLoading = true;
                ApiClient.put('subscribers/' + this.id, this.model)
                    .then(() => {
                        this.$router.push({'name': 'subscribers'});
                    });
            },
            fieldTitle(field) {
                return field.title + ' (' + field.type + ')';
            },
        }
    }
</script>

<style scoped>

</style>