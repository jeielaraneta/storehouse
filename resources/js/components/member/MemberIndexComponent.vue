<template>
    <div class="card">
        <div class="card-header">Members</div>
        <div class="card-body">
            <h3 class="title">v-Datatable example</h3>
            <data-table :header-fields="headerFields" :data="tableData">
              
            </data-table>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            fetchUrl: { 
                type: String
            }/*,
            columns: { 
                type: Array, 
                required: true },*/
        },
        data() {
            return {
                tableData: [],
                headerFields: [
                    {
                        name: "code",
                        label: "Code",
                        sortable: true
                    },
                    {
                        name: "name",
                        label: "Name",
                        sortable: true
                    },
                    {
                        name: "email",
                        label: "Email",
                        sortable: true
                    },
                    {
                        name: "membership_status",
                        label: "Membership Status",
                        sortable: true
                    },
                    {
                        name: "created_at",
                        label: "Created At",
                        sortable: true
                    }
                ]
            }
        },
        created() {
            return this.fetchData(this.fetchUrl)
        },
        methods: {
            fetchData(url) {
              axios.get(url)
                .then(data => { this.tableData = data.data.data })
            },
            /**
             * Get the serial number.
             * @param key
             * */
            serialNumber(key) {
              return key + 1;
            },
        },
        filters: {
            columnHead(value) {
              return value.split('_').join(' ').toUpperCase()
            }
        }
    }
</script>
