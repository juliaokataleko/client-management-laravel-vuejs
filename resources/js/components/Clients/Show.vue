<template>
  <div>
    <div v-if="loading" class="full-loader">
      <i class="fas fa-circle-notch fa-spin"></i>
    </div>

    <div v-if="!loading" class="card">
      <div
        class="
          card-header
          d-sm-flex
          align-items-center
          justify-content-between
          mb-2
        "
      >
        <h3>Detalhes do cliente ({{ client.name }})</h3>

        <div>
          <div class="btn-group">
            <router-link
              class="ml-3 btn-sm btn btn-primary"
              :to="{ name: 'Clients' }"
              ><i class="fa fa-arrow-left"></i> Voltar</router-link
            >

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
        </div>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-md-4 text-center">
            <img style="width: 100%; border-radius: 50%" :src="client.image" alt="" />
            <hr>
            <h4>Nome</h4>
            <p>{{ client.name }}</p>
          </div>

          <div class="col-md-8">
            <h4>Aniversário</h4>
            <p>{{ client.birthday }}</p>
            <hr />
            <h4>E-mail</h4>
            <p>{{ client.email }}</p>
            <hr />
            <h4>Telefone</h4>
            <p>{{ client.phone }}</p>
            <hr />
            <h4>Endereço</h4>
            <p>{{ client.address }}</p>
            <hr />
            <h4>Cidade</h4>
            <p>{{ client.city.name }}</p>
            <hr />
            <h4>Estado</h4>
            <p>{{ client.state.name }}</p>
            <hr />
            <h4>País</h4>
            <p>{{ client.country.name }}</p>
            <hr />
            <h4>Data de Cadastro</h4>
            <p>{{ client.created_at }}</p>
            <hr />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      client: {},
    };
  },
  mounted() {},
  created() {
    this.getClient();
  },
  methods: {
    getClient() {
      this.loading = true;

      axios
        .get("/api/clients/" + this.$route.params.id)
        .then((res) => {
          this.client = res.data.data[0];
          //  this.getStates();
          //  this.getCities();
          // console.log(res);
          this.loading = false;
        })
        .catch((error) => {
          this.loading = false;
          console.log(error);
        });
    },
    deleteClient(id) {
      if (confirm("Tens a certeza que queres excluir este cliente?")) {
        // delete sale
        this.loading = true;
        axios
          .delete("/api/clients/" + id)
          .then((res) => {
            // this.getData();

            if (res.data.success) {
              this.$router.push("/clients");
              //   this.showMessage = true;
              //   this.message = res.data.success;
              //   setTimeout(() => {
              //     this.showMessage = false;
              //   }, 3000);
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
