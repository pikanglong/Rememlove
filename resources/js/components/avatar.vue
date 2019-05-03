<template>
    <div class="a" :style=" 'height:' +  size">
        <img :src="asrc" :alt="aalt">
    </div>
</template>

<<script>
export default {
    props: {
        size : String,
        asrc : String,
        aalt : String
    }
}
</script>
<style>
    .a{
        display: inline-block;
        position: relative;
    }
    .a > img{
        width: inherit;
        height: inherit;
        border-radius: 2000px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 30px;
        border: 1px solid rgba(0, 0, 0, 0.15);
    }
</style>

