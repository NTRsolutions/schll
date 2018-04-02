// function search_data()
// {
//     var input_data = $('#search_data').val();
//     if (input_data.length === 0)
//     {
//         $('#suggestions').hide();
//     }
//     else
//     {
//         axios.post('\<?php echo base_url(); ?>Notice/autocomplete', {
//             search_data: input_data
//         })
//             .then(function (data) {
//                 console.log(data);
//             })
//             .catch(function (error) {
//                 console.log(error);
//             });
//     }
// }