<template>
  <div>
    <div style="max-width: 900px; margin: 0 auto" v-if="showMessage">
      <div class="alert mb-3 alert-success">{{ message }}</div>
    </div>

    <div v-if="loading" class="full-loader">
      <i class="fas fa-circle-notch fa-spin"></i>
    </div>

    <div v-if="!loading" class="card" style="max-width: 900px; margin: 0 auto">
      <div
        class="
          card-header
          d-sm-flex
          align-items-center
          justify-content-between
          mb-2
        "
      >
        <h5 class="h3 mb-0 text-gray-800">Cadastrar Cliente</h5>
        <router-link class="ml-3 btn btn-primary" :to="{ name: 'Clients' }"
          ><i class="fa fa-arrow-left"></i> Voltar</router-link
        >
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">Nome</label>
              <input
                type="text"
                v-model="client.name"
                class="form-control"
                id="name"
                name="name"
              />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="file">Foto</label>
              <input type="file" class="form-control" id="file" name="file" />
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="file">Excluir Foto</label>
              <select
                class="form-control"
                :disabled="client.id == 0"
                v-model="delete_avatar"
              >
                <option value="0">Não</option>
                <option value="1">Sim</option>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="email">E-mail</label>
              <input
                type="text"
                v-model="client.email"
                class="form-control"
                id="email"
                name="email"
              />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="phone">Telefone</label>
              <input
                type="text"
                v-model="client.phone"
                class="form-control"
                id="phone"
                name="phone"
              />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="date_hired">Data de aniversário</label>
              <datepicker
                v-model="client.birthday"
                input-class="form-control"
              ></datepicker>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="country_id">País</label>
              <select
                @change="getStates()"
                v-model="client.country_id"
                name="country_id"
                id="country_id"
                class="form-control"
              >
                <option
                  v-for="country in countries"
                  :value="country.id"
                  :key="country.id"
                >
                  {{ country.name }}
                </option>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="state_id">Estado</label>
              <select
                @change="getCities()"
                v-model="client.state_id"
                name="state_id"
                id="state_id"
                class="form-control"
              >
                <option
                  v-for="state in states"
                  :value="state.id"
                  :key="state.id"
                >
                  {{ state.name }}
                </option>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="city_id">Cidade</label>
              <select
                v-model="client.city_id"
                name="city_id"
                id="city_id"
                class="form-control"
              >
                <option v-for="city in cities" :value="city.id" :key="city.id">
                  {{ city.name }}
                </option>
              </select>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label for="address">Endereço</label>
              <input
                type="text"
                v-model="client.address"
                class="form-control"
                id="address"
                name="address"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="float-right">
          <button v-on:click="saveClient()" class="btn-outline-primary btn">
            <i class="fa fa-save"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import moment from "moment";

export default {
  components: {
    Datepicker,
  },
  data() {
    return {
      countries: [],
      states: [],
      cities: [],
      client: {
        id: 0,
        birthday: "",
        name: "",
        email: "",
        phone: "",
        country_id: "",
        state_id: "",
        city_id: "",
        address: "",
        photo: "",
      },
      search: {
        query: "",
      },
      loading: false,
      showMessage: false,
      message: "",
      delete_avatar: 0,
    };
  },
  created() {
    this.getCountries();

    if (this.$route.params.id) {
      this.getClient();
    }
  },
  mounted() {
    // this.getData();
    // this.getHelperData();
  },
  methods: {
    getClient() {
      this.loading = true;

      axios
        .get("/api/clients/" + this.$route.params.id)
        .then((res) => {
          this.client = res.data.data[0];
          this.getStates();
          this.getCities();
          console.log(res);
          this.loading = false;
        })
        .catch((error) => {
          this.loading = false;
          console.log(error);
        });
    },
    getHelperData() {},
    getCountries() {
      axios
        .get("/api/clients/countries")
        .then((res) => {
          this.countries = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getStates() {
      axios
        .get(`/api/clients/${this.client.country_id}/states`)
        .then((res) => {
          this.states = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getCities() {
      axios
        .get(`/api/clients/${this.client.state_id}/cities`)
        .then((res) => {
          this.cities = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    saveClient() {

    this.loading = true;

      if (this.client.name == "" || this.client.phone == "") {
        alert("Preencha pelo menos o nome e o telefone");
        return;
      }
      // format date
      this.client.birthday = this.format_date(this.client.birthday);

      let formData = new FormData();
      formData.append("file", document.getElementById("file").files[0]);
      formData.append("name", this.client.name);
      formData.append("email", this.client.email);
      formData.append("phone", this.client.phone);
      formData.append("birthday", this.client.birthday);
      formData.append("country_id", this.client.country_id);
      formData.append("state_id", this.client.state_id);
      formData.append("city_id", this.client.city_id);
      formData.append("address", this.client.address);
      formData.append("delete_avatar", this.delete_avatar);

      console.log("Dados...", formData);

      if (this.client.id != 0) {
        // update
        axios
          .post(`/api/clients?id=${this.$route.params.id}`, formData)
          .then((res) => {
            alert("Cliente atualizado.");
            this.$router.push("/clients");
            console.log(res);
            this.loading = false;
          })
          .catch((error) => {
            console.log(error);
            this.loading = false;
          });

      } else {
        // insert new client
        axios
          .post(`/api/clients`, formData)
          .then((res) => {
            alert("Cliente cadastrado.");
            this.$router.push("/clients");
            console.log(res);
            this.loading = false;
          })
          .catch((error) => {
            console.log(error);
            this.loading = false;
          });

          
      }
    },
    format_date(value) {
      if (value) {
        return moment(String(value)).format("YYYY-MM-DD");
      }
    },
  },
};
</script>
