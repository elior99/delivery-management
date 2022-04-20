<template>
  <div class="cardb">
    <h4 class="cardh text-center ">התחברות</h4>
    <br />

    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button
          class="nav-link active"
          id="home-tab"
          data-bs-toggle="tab"
          data-bs-target="#home"
          type="button"
          role="tab"
          aria-controls="home"
          aria-selected="true"
        >
          לקוח
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button
          class="nav-link"
          id="profile-tab"
          data-bs-toggle="tab"
          data-bs-target="#profile"
          type="button"
          role="tab"
          aria-controls="profile"
          aria-selected="false"
        >
          שליח
        </button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div
        class="tab-pane fade show active"
        id="home"
        role="tabpanel"
        aria-labelledby="home-tab"
      >
        <form>
          <div class="form-group">
            <div class="input-group  mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa fa-user"></i>
                </span>
              </div>
              <input
                type="text"
                :value="credentials[0].username"
                class="form-control"
                placeholder="Email or login"
              />
            </div>
            <!-- input-group.// -->
          </div>
          <!-- form-group// -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa fa-lock"></i>
                </span>
              </div>
              <input
                class="form-control"
                :value="credentials[0].password"
                placeholder="******"
                type="password"
              />
            </div>
            <!-- input-group.// -->
          </div>
          <!-- form-group// -->
          <div class="form-group">
            <button
              type="button"
              @click="login(0)"
              class="btn btn-primary btn-block"
            >
              התחבר
            </button>
          </div>
          <!-- form-group// -->
        </form>
      </div>
      <div
        class="tab-pane fade"
        id="profile"
        role="tabpanel"
        aria-labelledby="profile-tab"
      >
        <form>
          <div class="form-group">
            <div class="input-group  mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa fa-user"></i>
                </span>
              </div>
              <input
                type="text"
                :value="credentials[1].username"
                class="form-control"
                placeholder="Email or login"
              />
            </div>
            <!-- input-group.// -->
          </div>
          <!-- form-group// -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa fa-lock"></i>
                </span>
              </div>
              <input
                class="form-control"
                :value="credentials[1].password"
                placeholder="******"
                type="password"
              />
            </div>
            <!-- input-group.// -->
          </div>
          <!-- form-group// -->
          <div class="form-group">
            <button
              type="button"
              @click="login(1)"
              class="btn btn-primary btn-block"
            >
              התחבר
            </button>
          </div>
          <!-- form-group// -->
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["details"],
  data() {
    return {
      data: {},
      url: "/arci/api/sys.php?login=1",
      credentials: [
        { username: "demo", password: "demo", type: "2" },
        { username: "courier", password: "courier", type: "3" },
      ],
    };
  },
  methods: {
    login(userType) {
      fetch(this.url, {
        credentials: "include",
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(this.credentials[userType]),
      })
        .then((response) => {
          return response.json();
        })
        .then((response) => {
          if (response.status == "ok") {
            if (userType == 0) window.location = "userOrders";
            else if (userType == 1) window.location = "userDeliveries";
          }
        });
    },
  },
  created() {},
};
</script>

<style scoped>
.input-group-text {
  height: 100%;
}
.form-group {
  text-align: center;
}
</style>
