<template>
    <div class="card">
        <div class="card-header">Members</div>
        <div class="card-body">
            <data-table
                :id="tableId"
                :header-fields="headerFields" 
                :data="tableData || []"
                :sort-field="sortField"
                :sort="sort"
                :is-loading="isLoading"
                :css="datatableCss"
                not-found-msg="Items not found"
                @onUpdate="dtUpdateSort"
                trackBy="name"
            >
                <input
                    slot="actions"
                    slot-scope="props"
                    type="button"
                    class="btn btn-info"
                    value="Edit"
                    @click="dtEditClick(props);"
                />

                <pagination
                    :id="paginationId"
                    slot="pagination"
                    :page="currentPage"
                    :total-items="totalItems"
                    :items-per-page="itemsPerPage"
                    :css="paginationCss"
                    @onUpdate="changePage"
                    @updateCurrentPage="updateCurrentPage"
                />

                <div class="items-per-page" slot="ItemsPerPage">
                    <label>Items per page</label>
                    <itemsPerPageDropdown
                      :list-items-per-page="listItemsPerPage"
                      :items-per-page="itemsPerPage"
                      :css="itemsPerPageCss"
                      @onUpdate="updateItemsPerPage"
                    />
                </div>
                
                <spinner slot="spinner" />
              
            </data-table>
        </div>
    </div>
</template>

<style>

/* Datatable CSS */
#v-datatable-light .header-item {
  cursor: pointer;
  color: #337ab7;
  transition: color 0.15s ease-in-out;
}

#v-datatable-light .header-item:hover {
  color: #ed9b19;
}

#v-datatable-light .header-item.no-sortable {
  cursor: default;
}
#v-datatable-light .header-item.no-sortable:hover {
  color: #337ab7;
}

#v-datatable-light .header-item .th-wrapper {
  display: flex;
  width: 100%;
  height: 100%;
  font-weight: bold;
}

#v-datatable-light .header-item .th-wrapper.checkboxes {
  justify-content: center;
}

#v-datatable-light .header-item .th-wrapper .arrows-wrapper {
  display: flex;
  flex-direction: column;
  margin-left: 10px;
  justify-content: space-between;
}

#v-datatable-light .header-item .th-wrapper .arrows-wrapper.centralized {
  justify-content: center;
}

#v-datatable-light .arrow {
  transition: color 0.15s ease-in-out;
  width: 0;
  height: 0;
  border-left: 8px solid transparent;
  border-right: 8px solid transparent;
}

#v-datatable-light .arrow.up {
  border-bottom: 8px solid #337ab7;
}

#v-datatable-light .arrow.up:hover {
  border-bottom: 8px solid #ed9b19;
}

#v-datatable-light .arrow.down {
  border-top: 8px solid #337ab7;
}

#v-datatable-light .arrow.down:hover {
  border-top: 8px solid #ed9b19;
}

#v-datatable-light .footer {
  display: flex;
  justify-content: space-between;
  width: 500px;
}
/* End Datatable CSS */

/* Pagination CSS */
#v-datatable-light-pagination {
  list-style: none;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  margin: 0;
  padding: 0;
  width: 300px;
  height: 30px;
}

#v-datatable-light-pagination .pagination-item {
  width: 30px;
  margin-right: 5px;
  font-size: 16px;
  transition: color 0.15s ease-in-out;
}

#v-datatable-light-pagination .pagination-item.selected {
  color: #ed9b19;
}

#v-datatable-light-pagination .pagination-item .page-btn {
  background-color: transparent;
  outline: none;
  border: none;
  color: #337ab7;
  transition: color 0.15s ease-in-out;
}

#v-datatable-light-pagination .pagination-item .page-btn:hover {
  color: #ed9b19;
}

#v-datatable-light-pagination .pagination-item .page-btn:disabled {
  cursor: not-allowed;
  box-shadow: none;
  opacity: 0.65;
}
/* END PAGINATION CSS */

/* ITEMS PER PAGE DROPDOWN CSS */
.item-per-page-dropdown {
  background-color: transparent;
  min-height: 30px;
  border: 1px solid #337ab7;
  border-radius: 5px;
  color: #337ab7;
}
.item-per-page-dropdown:hover {
  cursor: pointer;
}
/* END ITEMS PER PAGE DROPDOWN CSS */
</style>

<script>
    import orderBy from "lodash.orderby";

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
                    },
                    "__slot:actions"
                ],

                datatableCss: {
                    table: "table table-bordered table-hover table-striped table-center",
                    th: "header-item",
                    thWrapper: "th-wrapper",
                    thWrapperCheckboxes: "th-wrapper checkboxes",
                    arrowsWrapper: "arrows-wrapper",
                    arrowUp: "arrow up",
                    arrowDown: "arrow down",
                    footer: "footer"
                },

                paginationCss: {
                    paginationItem: "pagination-item",
                    moveFirstPage: "move-first-page",
                    movePreviousPage: "move-previous-page",
                    moveNextPage: "move-next-page",
                    moveLastPage: "move-last-page",
                    pageBtn: "page-btn"
                },

                itemsPerPageCss: {
                    select: "item-per-page-dropdown"
                },

                isLoading: false,
                sort: "asc",
                sortField: "name",
                listItemsPerPage: [5, 10, 20, 50, 100],
                itemsPerPage: 10,
                currentPage: 1,
                totalItems: 16,
                tableId: "v-datatable-light",
                paginationId: "v-datatable-light-pagination"
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
            dtEditClick: props => alert("Click props:" + JSON.stringify(props)),

            dtUpdateSort: function({ sortField, sort }) {
              const sortedData = orderBy(this.tableData, [sortField], [sort]);
              const start = (this.currentPage - 1) * this.itemsPerPage;
              const end = this.currentPage * this.itemsPerPage;
              this.data = sortedData.slice(start, end);
              console.log("load data based on new sort", this.currentPage);
            },

            updateItemsPerPage: function(itemsPerPage) {
              this.itemsPerPage = itemsPerPage;
              if (itemsPerPage >= this.tableData.length) {
                this.data = this.tableData;
              } else {
                this.data = this.tableData.slice(0, itemsPerPage);
              }
              console.log("load data with new items per page number", itemsPerPage);
            },

            changePage: function(currentPage) {
              this.currentPage = currentPage;
              const start = (currentPage - 1) * this.itemsPerPage;
              const end = currentPage * this.itemsPerPage;
              this.data = this.tableData.slice(start, end);
              console.log("load data for the new page", currentPage);
            },

            updateCurrentPage: function(currentPage) {
              this.currentPage = currentPage;
              console.log("update current page without need to load data", currentPage);
            }
        },
        filters: {
            columnHead(value) {
              return value.split('_').join(' ').toUpperCase()
            }
        }
    }
</script>
