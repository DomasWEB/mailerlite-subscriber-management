<template>
    <div>
        <card>
            <template slot="title">Subscribers</template>
            <template slot="tools">
                <router-link :to="{ name: 'subscriber-create'}" class="button is-success">
                    Add subscriber
                </router-link>
            </template>

            <b-loading :active.sync="isLoading" :is-full-page="false"></b-loading>

            <b-table :data="data">
                <template slot-scope="props">
                    <b-table-column label="ID" numeric width="40">
                        {{ props.row.id }}
                    </b-table-column>

                    <b-table-column label="E-mail">
                        {{ props.row.email }}
                    </b-table-column>

                    <b-table-column label="Name">
                        {{ props.row.name }}
                    </b-table-column>

                    <b-table-column label="Created at">
                        {{ props.row.created_at }}
                    </b-table-column>

                    <b-table-column class="has-text-right">
                        <router-link :to="{ name: 'subscriber-edit', params: {subscriber: props.row.id}}"
                                     class="button is-info">
                            Edit
                        </router-link>

                        <a @click="remove(props.row.id)" class="button is-danger">Remove</a>
                    </b-table-column>
                </template>
            </b-table>

            <b-pagination
                    :current.sync="meta.current_page"
                    :per-page="meta.per_page"
                    :total="meta.total"
                    @change="changePage">
            </b-pagination>
        </card>
    </div>
</template>

<script>
    export default {
        name: "Subscribers",
        data() {
            return {
                isLoading: true,
                meta: {
                    current_page: 1,
                    perPage: 15,
                    total: 0
                },
                data: []
            }
        },
        created() {
            this.loadPage(1);
        },
        methods: {
            loadPage(page) {
                this.isLoading = true;
                ApiClient.get('subscribers', {
                    params: {
                        page
                    }
                }).then(response => {
                    let data = response.data;

                    this.data = data.data;
                    this.meta = data.meta;
                    this.isLoading = false;
                });
            },
            changePage(newPage) {
                this.loadPage(newPage);
            },
            reload() {
                this.loadPage(this.page);
            },
            remove(id) {
                this.isLoading = true;
                ApiClient.delete('subscribers/' + id)
                    .then(() => {
                        this.reload();
                    });
            }
        }
    }
</script>

<style scoped>

</style>