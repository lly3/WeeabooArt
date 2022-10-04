<template>
    <div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <button  ><i onclick="myFunction(this)" class="fa fa-thumbs-up"></i></button>
    </div>
</template>

<script>
export default {
    methods:{
        myFunction(x) {
            x.classList.toggle("fa-thumbs-down")
        }
    }
}
</script>
