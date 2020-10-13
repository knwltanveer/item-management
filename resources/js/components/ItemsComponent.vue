<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="alert alert-danger" v-if="errors.length > 0">
              <ul>
                <li v-for="error in errors" :key="error">{{ error }}</li>
              </ul>
            </div>
            <input
              type="text"
              name="item"
              id="item"
              v-model="newItem"
              v-on:keyup.enter="addItem()"
            />
            <button @click="addItem()">Add</button>
            <h3 class="mr-25 float-right">Selected Items</h3>
            <hr />
            <div class="box">
              <div
                class="list-group"
                v-for="(item, index) in items"
                :key="index"
              >
                <a
                  href="#"
                  class="list-group-item list-group-item-action"
                  @click="updateSelected(item)"
                  v-if="!item.is_selected"
                >
                  {{ item.name }}
                </a>
              </div>

              <!-- <ul v-for="item in items" :key="item.id" @click="updateSelected(item)" >
                <li class="text" v-if="item.is_selected"  style="background-color: red;">
                  {{ item.name }}
                </li>
              </ul> -->
            </div>

            <div class="box-button">
              <div style="margin-top: 103px">
                <button @click="move('right')">&gt;</button>
                <br />
                <br />
                <button @click="move('left')">&lt;</button>
              </div>
            </div>

            <div class="box">
              <div
                class="list-group"
                v-for="(item, index) in items"
                :key="index"
              >
                <a
                  href="#"
                  class="list-group-item list-group-item-action"
                  @click="updateSelected(item)"
                  v-if="item.is_selected"
                >
                  {{ item.name }}
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr />

  </div>
</template>
<script>
export default {
  data() {
    return {
      newItem: "",
      items: [],
      errors: [],
      selectedItem: {},
    };
  },
  mounted() {
    this.getItemsList();
  },
  methods: {
    getItemsList() {
      axios
        .get("/item")
        .then((response) => {
          this.items = response.data.obj.items;
          //   this.items.map(function (i) {
          //     return (i.colorIt = false);
          //   });
        })
        .catch((error) => {
          console.log(error.response.data);
          //   this.errors = [];
          //   if (error.response.data.errors && error.response.data.errors.name) {
          //     this.errors.push(error.response.data.errors.name[0]);
          //   }
        });
    },
    addItem() {
      this.errors = [];
      axios
        .post("/item", {
          name: this.newItem,
        })
        .then((response) => {
          this.items.push(response.data.obj.item);
          this.reset();
        })
        .catch((error) => {
          console.log(error.response.data);
          this.errors = [];
          if (error.response.data.errors && error.response.data.errors.name) {
            this.errors.push(error.response.data.errors.name[0]);
          }
        });
    },
    reset() {
      this.newItem = "";
    },
    updateSelected(item) {
      this.selectedItem = item;
    },
    move(dir) {
      const selectedItemIndex = this.items.findIndex(
        (v) => v.id == this.selectedItem.id
      );
      if (dir == "right") {
        const data = { is_selected: 1 };
        axios
          .put(`/item/${this.selectedItem.id}`, data)
          .then((response) => {
            this.items[selectedItemIndex].is_selected = 1;
          })
          .catch((error) => {
            console.log(error.response.data);
          });
      } else if (dir == "left") {
        const data = { is_selected: 0 };
        axios
          .put(`/item/${this.selectedItem.id}`, this.selectedItem)
          .then((response) => {
            this.items[selectedItemIndex].is_selected = 0;
          })
          .catch((error) => {
            console.log(error.response.data);
          });
      }
    },
  },
};
</script>
<style lang="css">
.box {
  height: 350px;
  overflow-y: scroll;
  border-color: grey;
  border-style: solid;
  width: 48%;
  display: inline-block;
  border-radius: 5px;
}

.box-button {
  height: 350px;
  overflow-y: auto;

  width: 3%;
  display: inline-block;
}

.list-group-item {
  display: block;
  text-decoration: none;
  color: #4a4a4a;
}

.mr-25 {
  margin-right: 25%;
}
</style>
