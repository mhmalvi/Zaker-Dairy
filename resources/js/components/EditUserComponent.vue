<template>
  <div class="row">
    <div class="col-md-4">
      <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
          <div>
            <img
              v-if="state.photo"
              id="profileImg"
              :src="
                'https://zakerdairyfarm.com/assets/img/users/' + state.photo
              "
              class="user-picture img-thumbnail rounded-circle"
              alt="User profile picture"
            />
            <img
              v-else
              id="profileImg"
              :src="'https://zakerdairyfarm.com/assets/img/users/user.png'"
              class="user-picture img-thumbnail rounded-circle"
              alt="User profile picture"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group row">
        <input type="hidden" v-model="id" />
        <div class="col-md-6">
          <label class="form-label">Username</label>
          <input
            type="text"
            class="form-control"
            name="username"
            v-model="state.user.name"
          />
        </div>
        <div class="col-md-6">
          <div class="d-flex flex-column">
            <div class="d-flex justify-content-end">
              <button
                class="btn btn-sm status-btn"
                :class="{
                  'btn-success':
                    state.status_state == 1 || state.status_state == 4,
                  'btn-danger':
                    state.status_state == 2 || state.status_state == 3,
                }"
                @mouseenter="state.status_state++"
                @mouseleave="
                  state.status_state % 2 == 0 && --state.status_state
                "
                @click="changeStatus"
                :disabled="state.status_state == 5"
              >
                <span v-show="state.status_state < 5">
                  {{ status_label }}
                </span>
                <span v-show="state.status_state == 5">
                  <i class="bi bi-cloud"></i>
                </span>
              </button>
            </div>
            <div class="d-flex justify-content-end">
              <p>{{ state.status_error }}</p>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-6">
          <label class="form-label">First name</label>
          <input
            type="text"
            v-model="state.user.first_name"
            class="form-control"
            name="first_name"
          />
        </div>
        <div class="col-md-6">
          <label class="form-label">Last name</label>
          <input
            type="text"
            v-model="state.user.last_name"
            class="form-control"
            name="first_name"
          />
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">Email</label>
            <input
              type="email"
              v-model="state.user.email"
              class="form-control"
              name="email"
            />
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">Phone</label>
            <input
              type="text"
              v-model="state.user.phone"
              class="form-control"
              name="phone"
            />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">Photo</label>
            <input
              type="file"
              @change="photoUpload"
              class="form-control"
              id=""
              accept="image/*"
            />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">Address</label>
            <input
              name="address"
              class="form-control"
              id=""
              v-model="state.user.address"
            />
          </div>
        </div>
      </div>

      <div class="form-group">
        <button class="btn btn-success" @click="update" id="update">
          Update
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, computed } from "vue";
import axios from "axios";
import Button from "../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Button.vue";

export default {
  data() {
    return {
      image: null,
    };
  },
  methods: {
    photoUpload(e) {
      this.image = e.target.files[0];
    },
    update() {
      const fd = new FormData();
      fd.append("id", this.state.user.id);
      fd.append("image", this.image);
      fd.append("name", this.state.user.name);
      fd.append("first_name", this.state.user.first_name);
      fd.append("last_name", this.state.user.last_name);
      fd.append("phone", this.state.user.phone);
      fd.append("email", this.state.user.email);
      fd.append("address", this.state.user.address);

      axios.post("/admin/users/update", fd).then((res) => {
        $("#update")
          .text("UPDATED")
          .css("background", "#28a745")
          .css("color", "white")
          .css("border-color", "#28a745");
        setTimeout(() => {
          $("#update")
            .text("Update")
            .css("background", "#00e3bc")
            .css("color", "white")
            .css("border-color", "#00e3bc");
        }, 1000);

        $("#profileImg").attr(
          "src",
          "https://zakerdairyfarm.com/assets/img/users/" + res.data.photo
        );
      });
    },
  },
  components: { Button },
  props: ["data", "photo"],
  setup({ data, photo }) {
    const user_obj = JSON.parse(data);

    const state = reactive({
      photo: photo,
      user: user_obj,
      submitting: false,
      status_state: user_obj.is_suspended == "no" ? 1 : 3,
      status_error: "",
    });

    const status_label = computed(() => {
      if (state.status_state == 1) {
        return "Active";
      } else if (state.status_state == 2) {
        return "Suspend?";
      } else if (state.status_state == 3) {
        return "Suspended";
      } else if (state.status_state == 4) {
        return "Activate?";
      }
    });

    const changeStatus = () => {
      let old_status = state.status_state;
      state.status_state = 5;
      state.status_error = "";

      axios
        .patch("/admin/users/" + state.user.uuid + "/status/toggle")
        .then((res) => {
          if (res.data.status == "yes") {
            state.status_state = 3;
          } else {
            state.status_state = 1;
          }
        })
        .catch((err) => {
          state.status_state = old_status;
          state.status_error = err.response.data.message;

          if (err.response.data.status == "yes") {
            state.status_state = 3;
          } else {
            state.status_state = 1;
          }
        });
    };

    return {
      state,
      status_label,
      changeStatus,
    };
  },
};
</script>

<style scoped>
.user-picture {
  width: 100%;
  height: auto;
  max-height: 200px;
}

.status-btn:disabled {
  color: rgb(255, 255, 255);
  background-color: #a0a0a0;
  border-color: #878788;
}
</style>
