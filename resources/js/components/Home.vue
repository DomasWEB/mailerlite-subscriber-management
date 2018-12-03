<template>
    <card>
        <template slot="title">
            Dashboard
        </template>

        <nav class="level">
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Subscribers</p>
                    <p class="title">{{ subscribers }}</p>
                    <p class="last-item">
                        <router-link :to="{ name: 'subscriber-create'}" class="button is-success">
                            Add subscriber
                        </router-link>
                    </p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Fields</p>
                    <p class="title">{{ fields }}</p>
                    <p class="last-item">
                        <router-link :to="{ name: 'field-create'}" class="button is-success">
                            Add field
                        </router-link>
                    </p>
                </div>
            </div>
        </nav>
    </card>
</template>

<script>
    export default {
        name: "Home",
        data() {
            return {
                subscribers: 0,
                fields: 0
            }
        },
        created() {
            ApiClient.get('subscribers').then(response => {
                this.subscribers = response.data.meta.total;
            });
            ApiClient.get('fields').then(response => {
                this.fields = response.data.meta.total;
            });
        }
    }
</script>

<style scoped>
    .last-item {
        margin-top: 1rem;
    }
</style>