<template>
  <form @submit.prevent="handleFormSubmit">
    <div class="single-input-item mb-3">
      <label for="current_password" class="required mb-1"
        >Current Password</label
      >
      <input
        type="password"
        id="current_password"
        placeholder="Your current password"
        v-model="state.form.current_password"
      />
      <small
        class="text-danger"
        v-if="
          state.validation.errors && state.validation.errors.current_password
        "
      >
        {{ state.validation.errors.current_password[0] }}
      </small>
    </div>

    <div class="single-input-item mb-3">
      <label for="new_password" class="required mb-1">New Password</label>
      <input
        type="password"
        id="new_password"
        placeholder="Your new password"
        v-model="state.form.new_password"
      />
      <small
        class="text-danger"
        v-if="state.validation.errors && state.validation.errors.new_password"
      >
        {{ state.validation.errors.new_password[0] }}
      </small>
    </div>

    <div class="single-input-item mb-3">
      <label for="new_password_confirmation" class="required mb-1"
        >New Password Confirmation</label
      >
      <input
        type="password"
        id="new_password"
        placeholder="Your new password confirmation"
        v-model="state.form.new_password_confirmation"
      />
      <small
        class="text-danger"
        v-if="
          state.validation.errors &&
          state.validation.errors.new_password_confirmation
        "
      >
        {{ state.validation.errors.new_password_confirmation[0] }}
      </small>
    </div>

    <div class="form-group">
      <button
        type="submit"
        class="btn obrien-button primary-btn"
        :disabled="state.saving"
      >
        Update Password
      </button>
    </div>
  </form>
</template>

<script>
import { reactive } from "@vue/reactivity";
import usePassword from "../../composables/usePassword";

export default {
  setup() {
    const state = reactive({
      form: {
        current_password: "",
        new_password: "",
        new_password_confirmation: "",
      },
      validation: {
        errors: [],
        message: "",
      },
      saving: false,
    });

    const { update: updatePassword } = usePassword();

    const handleFormSubmit = () => {
      state.saving = true;
      resetErrors();

      updatePassword(state.form)
        .then((res) => {
          alert(res.data.message);
          resetForm();
        })
        .catch((err) => {
          if (err.response.status == 422) {
            state.validation.errors = err.response.data.errors;
            state.validation.message = err.response.data.message;
          } else {
            alert(err.response.data.message);
          }
        })
        .finally(() => {
          state.saving = false;
        });
    };

    const resetErrors = () => {
      state.validation = {
        errors: [],
        message: "",
      };
    };

    const resetForm = () => {
      state.form.current_password = "";
      state.form.new_password = "";
      state.form.new_password_confirmation = "";
    };

    return {
      state,
      handleFormSubmit,
    };
  },
};
</script>
