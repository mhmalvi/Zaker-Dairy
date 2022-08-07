<template>
  <div>
    <form @submit.prevent="handleFormSubmit">
      <div class="row">
        <div class="col-lg-6 col-custom">
          <div class="single-input-item mb-3">
            <label for="first-name" class="required mb-1">First Name</label>
            <input
              type="text"
              id="first-name"
              placeholder="First Name"
              v-model="state.form.first_name"
            />
            <small
              class="text-danger"
              v-if="
                state.validation.errors && state.validation.errors.first_name
              "
            >
              {{ state.validation.errors.first_name[0] }}
            </small>
          </div>
        </div>
        <div class="col-lg-6 col-custom">
          <div class="single-input-item mb-3">
            <label for="last-name" class="required mb-1">Last Name</label>
            <input
              type="text"
              id="last-name"
              placeholder="Last Name"
              v-model="state.form.last_name"
            />
            <small
              class="text-danger"
              v-if="
                state.validation.errors && state.validation.errors.last_name
              "
            >
              {{ state.validation.errors.last_name[0] }}
            </small>
          </div>
        </div>

        <div class="single-input-item mb-3">
          <label for="display-name" class="required mb-1">Display Name</label>
          <input
            type="text"
            id="display-name"
            placeholder="Display Name"
            v-model="state.form.display_name"
          />
          <small
            class="text-danger"
            v-if="
              state.validation.errors && state.validation.errors.display_name
            "
          >
            {{ state.validation.errors.display_name[0] }}
          </small>
        </div>

        <div class="single-input-item mb-3">
          <label for="email-address" class="required mb-1">Email Address</label>
          <input
            type="text"
            id="email-address"
            placeholder="Email Address"
            v-model="state.form.email"
            disabled
          />
        </div>

        <div class="form-group">
          <button
            type="submit"
            class="btn obrien-button primary-btn"
            :disabled="state.saving"
          >
            Save Changes
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { onMounted, reactive } from "vue";
import axios from "axios";

export default {
  setup() {
    const state = reactive({
      form: {
        first_name: "",
        last_name: "",
        display_name: "",
        email: "",
      },
      validation: {
        errors: [],
        message: "",
      },
      saving: false,
    });

    onMounted(() => {
      getUserInfo();
    });

    const getUserInfo = () => {
      axios.get("/user/profile/info").then((res) => {
        state.form.first_name = res.data.data.first_name;
        state.form.last_name = res.data.data.last_name;
        state.form.display_name = res.data.data.name;
        state.form.email = res.data.data.email;
      });
    };

    const handleFormSubmit = () => {
      resetValidation();
      state.saving = true;

      axios
        .patch("/user/profile/update", state.form)
        .then((res) => {
          alert(res.data.message);
        })
        .catch((err) => {
          if (err.response.status == 422) {
            state.validation.errors = err.response.data.errors;
            state.validation.message = err.response.data.message;
          } else alert(err.response.data.message);
        })
        .finally(() => {
          state.saving = false;
        });
    };

    const resetValidation = () => {
      state.validation = {
        errors: [],
        message: "",
      };
    };

    return {
      state,
      handleFormSubmit,
    };
  },
};
</script>
