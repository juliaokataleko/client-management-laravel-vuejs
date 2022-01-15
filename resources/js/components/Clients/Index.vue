<template>
  <div>
    <div style="max-width: 1200px; margin: 0 auto" v-if="showMessage">
      <div class="alert mb-3 alert-success">{{ message }}</div>
    </div>

    <div v-if="loading" class="full-loader">
      <i class="fas fa-circle-notch fa-spin"></i>
    </div>

    <div v-if="!loading" class="card" style="max-width: 1200px; margin: 0 auto">
      <div
        class="
          card-header
          d-flex
          align-items-center
          justify-content-between
          mb-2
        "
      >
        <h5 class="h3 mb-0 text-gray-800">Clientes</h5>
        <router-link class="ml-3 btn btn-primary" :to="{ name: 'AddClient' }"
          ><i class="fa fa-plus"></i
        ></router-link>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="myData" class="table table-bordered">
            <thead>
              <tr>
                <th></th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>País</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="client in clients" :key="client.id">
                <td>
                  <img
                    style="width: 40px; height: 40px; object-fit: cover"
                    :src="client.image"
                    :alt="client.name"
                  />
                </td>
                <td>{{ client.name }}</td>
                <td>{{ client.email }}</td>
                <td>{{ client.phone }}</td>
                <td>{{ client.city.name }}</td>
                <td>{{ client.state.name }}</td>
                <td>{{ client.country.name }}</td>
                <td>
                  <div class="btn-group">
                    <router-link
                      class="btn btn-sm btn-outline-primary"
                      :to="{ name: 'ShowClient', params: { id: client.id } }"
                      ><i class="fa fa-eye"></i
                    ></router-link>
                    <router-link
                      class="btn btn-sm btn-outline-success"
                      :to="{ name: 'EditClient', params: { id: client.id } }"
                      ><i class="fa fa-edit"></i
                    ></router-link>
                    <a
                      v-on:click="deleteClient(client.id)"
                      href="#"
                      class="btn btn-sm btn-outline-danger"
                    >
                      <i class="fa fa-times"></i>
                    </a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer"></div>
    </div>
  </div>
</template>

<script>
import "datatables/media/js/jquery.dataTables";
import "datatables/media/css/jquery.dataTables.min.css";

export default {
  data() {
    return {
      clients: [],
      search: {
        query: "",
      },
      loading: false,
      showMessage: false,
      message: "",
    };
  },
  created() {
    // this.getData();
    // $("#myData").DataTable();
  },
  mounted() {
    this.getData();
    this.getHelperData();
  },
  methods: {
    getData() {
      this.loading = true;
      // $('#myData').DataTable().clear();
      // $("#myData").DataTable().destroy();

      axios
        .get("/api/clients", {
          params: this.search,
        })
        .then((res) => {
          console.log(res);

          if (res.data.warning) {
            alert(res.data.warning);
            // this.showMessage = true;
            // this.message = res.data.warning;
            this.loading = false;
          } else {
            this.clients = res.data.data;

            // setTimeout(() => {
            //   $("#myData").DataTable({
            //     pageLength: 10,
            //     bDestroy: true,
            //     order: [[0, "desc"]],
            //   });
            // }, 10);

            this.loading = false;
          }
        });
    },
    getHelperData() {
      //   axios
      //     .get("/api/saledata", {
      //       params: {
      //         store: this.search.store,
      //       },
      //     })
      //     .then((res) => {
      //       this.clients = res.data.clients;
      //       this.stores = res.data.stores;
      //       this.employes = res.data.employes;
      //       if (this.stores.length == 1) {
      //         this.search.store = this.stores[0].id;
      //       }
      //     });
    },
    cleanSearch() {
      //   this.search.employer = "";
      //   this.search.client = "";
      //   this.search.date = "";
      //   this.search.dateType = "Data";
      //   this.search.dateFrom = "";
      //   this.search.dateTo = "";
      //   this.getData();
    },
    toggleSearchOpen() {
      this.searchOpen = !this.searchOpen;
    },
    deleteClient(id) {
      if (confirm("Tens a certeza que queres excluir este cliente?")) {
        // delete sale
        this.loading = true;
        axios
          .delete("/api/clients/" + id)
          .then((res) => {
            this.getData();

            if (res.data.success) {
              this.showMessage = true;
              this.message = res.data.success;
              setTimeout(() => {
                this.showMessage = false;
              }, 3000);
            }
            this.loading = false;
          })
          .catch((error) => {
            console.log(error);
            this.loading = false;
          });
      }
    },
  },
};
</script>

