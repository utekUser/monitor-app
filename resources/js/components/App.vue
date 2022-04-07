<template>
  <div>
    <button @click="create()" id="add-btn">Add shape</button>
    <button @click="get_data()" id="get_data">Get Data</button>
    <v-stage ref="stage" :config="stageSize">
      <!-- <v-layer>
                <v-group :config="{draggable: true, x: 30, y: 70}">
                    <v-rect
                    :config="{
                        width: 200,
                        height: 100,
                        fill: '#0294f5',
                    }"
                    />
                    <v-text :config="{text: 'DATA', fontSize: 15}"/>
                </v-group>
            </v-layer> -->
      <v-layer ref="dragLayer"></v-layer>
    </v-stage>
  </div>
</template>
<script>
const width = window.innerWidth;
const height = window.innerHeight;
var layer = 0;

export default {
  data() {
    return {
      stageSize: {
        width: width,
        height: height,
      },
      isDragging: false,
    };
  },
  methods: {
    handleClick: function (event) {
      //   const stage = evt.target.getStage();
      //   const pos = stage.getPointerPosition();
      //   this.list.push(pos);
      //   this.save();
    },

    create_layer() {
      // Create mew layer
      this.layer = new Konva.Layer({ name: "layer" });

      // Add to stage
      this.getStage.add(this.layer);
    },

    create: function () {
      var i = 1;
      var AxisX = i * 100;
      var AxisY = 20;
      var Text = this.get_data();

      console.log(Text);
      var cardGroup = new Konva.Group({
        draggable: true,
        x: AxisX,
        y: AxisY,
        name: "card " + i,
      });
      var cardName = new Konva.Text({
        fontSize: 18,
        fontFamily: "Calibri",
        text: Text,
        fill: "#fff",
        padding: 10,
        name: "cardText " + i,
      });
      var cardText = new Konva.Text({
        fontSize: 15,
        fontFamily: "Calibri",
        text: Text,
        fill: "#fff",
        padding: 30,
        name: "cardText " + i,
      });
      var cardRect = new Konva.Rect({
        width: 200,
        height: 100,
        fill: "#0294f5",
        stroke: "#02c4f5",
        strokeWidth: 4,
        name: "cardRect " + i,
      });
      cardGroup.add(cardRect).add(cardName).add(cardText);
    //   layer.add(cardGroup);
    //   cardnameList[i] = cardGroup;
      //   }
      i++;
    //   tr.forceUpdate();
    //   tr.nodes(cardnameList);
      this.add_to_layer(cardGroup);
    },

    make_card: function (object) {

    },

    get_data: function () {
        var obj;
        var id;
        var json;
        $.ajax({
            type: 'GET',
            url: '/getdata',
            async: 'false',
            dataType: "json",
            success: function (data) {
            //   console.log(data);
              obj = data;
            },
            error: function(data) {
                // console.log(data);
            }
        });
        console.log(obj);
        return obj;
    },

    add_to_layer: function (object) {
      // Layer
      this.getLayer.add(object);

      // Draw
      this.draw_layer();
    },

    draw_layer: function () {
      this.layer.draw();
    },

    load() {
      const data = localStorage.getItem("storage") || "[]";
      this.list = JSON.parse(data);
    },

    save() {
      localStorage.setItem("storage", JSON.stringify(this.list));
    },

    handleDragStart() {
      this.isDragging = true;
    },
    handleDragEnd() {
      this.isDragging = false;
    },
  },

  computed: {
    // Get layer
    getLayer: function () {
      return this.layer;
    },

    // Get stage
    getStage: function () {
      // Return back stage
      return this.$refs.stage.getStage();
    },
  },

  mounted() {
    // this.load();
    this.create_layer();
  },
};
</script>
