<template>
    <card>
        <template slot="title">Fields</template>
        <template slot="tools">
            <router-link :to="{ name: 'field-create'}" class="button is-success">
                Add field
            </router-link>
        </template>

        <b-loading :active.sync="isLoading" :is-full-page="false"></b-loading>

        <b-table :data="data">
            <template slot-scope="props">
                <b-table-column label="ID" numeric width="40">
                    {{ props.row.id }}
                </b-table-column>

                <b-table-column label="Title">
                    {{ props.row.title }}
                </b-table-column>

                <b-table-column label="Type">
                    {{ props.row.type }}
                </b-table-column>

                <b-table-column label="Created at">
                    {{ props.row.created_at }}
                </b-table-column>

                <b-table-column class="has-text-right">
                    <router-link :to="{ name: 'field-edit', params: {field: props.row.id}}"
                                 class="button is-info">
                        Edit
                    </router-link>

                    <a @click="remove(props.row.id)" class="button is-danger">Remove</a>
                </b-table-column>
            </template>
        </b-table>

        <b-pagination
                :current.sync="meta.current_page"
                :per-page="meta.perPage"
                :total="meta.total"
                @change="changePage">
        </b-pagination>
    </card>
</template>

<script>
    export default {
        name: "Fields",
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
                ApiClient.get('fields', {
                    params: {
                        page
                    }
                }).then(response => {
                    let data = response.data;

                    this.data = data.data;
                    this.meta = data.meta;
                    this.isLoading = false;
                })
            },
            changePage(newPage) {
                this.loadPage(newPage);
            },
            reload() {
                this.loadPage(this.page);
            },
            remove(id) {
                this.isLoading = true;
                ApiClient.delete('fields/' + id)
                    .then(() => {
                        this.reload();
                    });
            }
        }
    }
</script>

<style scoped>

</style>