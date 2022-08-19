<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
              <?php
              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer'){
              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
              ?>
 <!-- <div class="pull-left">
   <form method="post" action="<?php base_url('admin/delivery_person');?>">
     <div class="input-group mb-15" style="width:300px;">
       <select id="selected_branch" name="selected_branch" class="form-control">
         <option value="all">All Transporter</option>
         <?php foreach ($branch as $k => $v) { ?>
         <option <?php if(!empty($fetch) && $fetch['selected_branch'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
         <?php } ?>
       </select>
			<span class="input-group-btn">
			<button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
				</span>
		</div>
   </form>
 </div> -->
 <?php
}
}
?>

 <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
  if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
?>
                <div class="pull-right">
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/delivery_person/create'); ?>">Add new Transporter</a>
                </div>
                <?php
              }
            }
          }
              ?>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table id="datable_1010" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                      <th>Transporter ID</th>
                                        <th>Transporter Name</th>
                                        <th>Contact Number</th>
                                        <th>ID TYPE / NO.</th>
                                        <th>Transporter Type</th>
                                        <th>Service Type</th>

                                        <th>Monthly Salary</th>
                                        <th>Del Commission</th>
                                        <th>Pick Commission</th>
                                        <th>Oil Bill</th>

                                        <th>Office</th>
                                        <?php
                          if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
                           ?>
                                        <th>Action</th>
                                      <?php
                                     }
                                   }
                                      ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($row as $k => $v) {
                                        ?>
                                        <tr data-id="<?php echo $v['id'];?>">
                                          <td><?php echo $v['transporter_id'] ?></td>
                                          <td><?php echo $v['name'] ?></td>
                                            <td><?php echo $v['phone'] ?></td>
                                            <td><?php echo ucfirst($v['id_type']) ?> / <?php echo $v['nid'] ?></td>
                                            <td><?php if($v['transporter_type'] == 'motorist'){ echo 'Rider'; } else { echo ucfirst($v['transporter_type']);} ?></td>
                                            <td><?php echo ucfirst($v['user_type']) ?></td>

                                            <td><?php echo $v['month_salary'] ?></td>
                                            <td><?php echo $v['del_comission'] ?></td>
                                            <td><?php echo $v['pick_comission'] ?></td>
                                            <td><?php echo $v['oil_bill'] ?></td>

                                            <td><?php echo $v['branch_name'] ?></td>
                                            <?php
                              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                                if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
                               ?>
                                            <td>
                                              <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){?>
                                                <button class="btn btn-default btn-icon-anim btn-square list-button" onclick="actionFunction()" data-tag="edit" data-url="<?php echo base_url("admin/delivery_person/create/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;
                                              <button class="btn btn-info btn-icon-anim btn-square list-button" onclick="actionFunction()" data-title="DELIVERY_PERSON" data-tag="delete" data-url="<?php echo base_url("admin/delivery_person/delete/".$v['id']);?>"><i class="fa fa-trash-o"></i></button>&nbsp;
                                              <?php
                                            }
                                            ?>
                                            <a href="<?php echo base_url('admin/delivery_person/print_transporter')."/".$v['id']; ?>" class="btn btn-success btn-icon-anim btn-square list-button" title="Print" target="_blank"><i style="margin-top: 15px;" class="fa fa-print"></i></a></td>
                                            <?php
                                          }
                                        }
                                          ?>
                                        </tr>


                                        <?php
                                    }
                                    ?>


                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<!-- <script>
$(document).ready(function() {
    $('#datable_1010').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf'
        ]
    } );
} );
</script> -->

<script>
var logoimage = '<?php echo base_url(); ?>/asset/img/logo.png'
console.log(logoimage);
$(document).ready(function() {
    $('#datable_1010').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          'excel','pageLength',
            {
                extend: 'pdfHtml5',
                customize: function ( doc ) {
                  doc['header']=(function() {
                    return {
                      columns: [
                        {
                          image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKgAAABUCAYAAAAWG3zWAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAABmJLR0QA/wD/AP+gvaeTAAAAB3RJTUUH5QMCDjAR2JypwQAAI2lJREFUeNrtnXeYHMWZ/z/VM5sUVquIAkIJJIFABAmRObLIPwPGYPDZgA0YDh9njLEBY3Em+DA+4wMHwIbDNnDGBAcwGQtsgwFJIBAgrUBhFVBCWVptmO76/fHWu13TO7M7o12tJDPv88zTM9Pd1RW+9eaqhhKVqEQlKlGJSlSiEpWoa8ls7wpsD5oxfEzecxMW1m7v6pXIo2B7V6CryYFTJ2YApL3fpi3wlqjr6VPFQWcMH6PttUAKiLzv1v02gC1x0h2DPjUATYAzDWSAEcBk4AGgATATFtba7V3XEsX0qQCoJ9Z9cJ4APAj0B54DLgYWI2LfloC6Y9CnRQdVcKYQcJ4JPIuAsxHhotd715ZoB6F/+sHwuGcAhMC+wKtAd6AZKANeAE5GwFsS8zsQfRo4qE7CyB1/hIAzg4BzC/Dv7ncKsJ6+uiOT8Y6Bq3sq8f9OT13diE57nspse/BxTFu2iAAwJm/xyj0nI6Ldt95/B5xDrJvu0AMbWsukurm4+geuvqHXJca1K/R+77QSId0Fz0h2XKdQy+i8/mI4b+ReZk2YCdpAlg7YOd7tSq971+zwZKXuIRC4jg2BfsBQxBMxH9GrfTfaTgvSbQ1Q7RhVJTJ0UmeNr6g0ZcbYNWGYumT5IhtBptIE5pnNG7LKduI64+pwcKJeAGvcMXTX7cjRJL8/IwsDgduAM4Ce7twC4PvAL/knUOG2pTjzLecQqAC+C4xDZnpHOs+68uooq/j220OG35ixdt/AmNXW2rIcoj5y158MlLv/Qle3/wD+B3E5VSKG047ITa21tiKCukl1c68EhgCvAKOIuaS2NQD+G7jafdfJuNNx0W3JQXWmh8hMfwQ4kuzO7AhFBgLb3Nh3t4rKWxc3NrzcbG3/wJhiyz/AHVcjxpICd0ejCBHrHwJXIsbeKKAJMfZ8ygDfAF5EdG4V9zsdbSsRoJZlBBwNvEPngDNCABQC1kJo4Py+te9cuWu67DADK6y1haoQ2vZDEc55JfA1YFmOa8M8n21BfhuzPhaoCoL6CmNGAae768sTfRp4vy/aRnXsMtpWIt4PK05C9KMNyEy33jV+Z+r1ScVer1sP/BcippXLXQr8o9yYIU3W/n3T6PHp9xsbhqSNybjy0kAvV44Ffg3skaP8E5FoUgB0A8YioG0k5v5ViXoa9/w3EbfVWrJBa4AaskUsZOuRAVAPbHLlVwBfAK4gFtXo94y1L0waMOQLVdNfPrDB2qcS1/ik/78H7JN4bqHjtkNQZ4j4fAkY+v+bnVC+RoBWuv8i99+7wKzGA46Y9dbqFSNrmxovTRuzyV1TCcwD7kcmRjMi7vbw7tfjJQhA08BmYDqxBBhIfm75LjDTlf85oA+xDrsFeAgBeZbzPxF67Y0YOScDeyG6JWQDT+9d/vWP3lsZYDIFYqg5MUa5+jbpYdGCfdfVdqOOAjTZwFx6js8llZtkEK46HhiJcLl6YDbwNmJEqV6lIFJLvHX9yyuIrB0UGHONtdYa0UMDZHLc7933B0SM628dlNMRTjPL+08B6qfj5eu/SuBWYDdi7rUO+BPO5TNj+Bjfb9mEJKp8B/i8u79dCoCRZeX0TqXer89E6xAOnUtt0jrM8NqZ5O4qVdLemPjj6X/fbiDtiA6ayzF8ELBL4jr121lkRlcAU4Ba4O+I2L0LuA94DQHJpcS6mN6vZfkk/69bTWBMBGBEvCvnaHJH/f1XROz5nR4ig/Qlr12R98y2dM3Iu0afkfGOyTL0uqtdOy90/dGiV7fT4dGlNf1YmmleAvzKa5tKLQVa2kBYacy9AF/r3c9MHzbazBg+xswYPoZDKrtpkYH33KOAXyBh34nEash25aBbC1Bfj1LudgkCsME5ylZuNAgByY0IkDNeB0Tu9yjgbkQc9ya/npWP0sTcN534P4P4B/V5fj0/h3DyTHsPyEPKedPeb+N9DxGO9wxwO8I1VYwmw5R5aX5zI/bAo1LAdQiY1EgyBkzgOKKFCxqsnQakKkyQMTKBDZC+uu8AHcMIOA54GZiKTJjjkOia3/fbLbpWLEB91q+iAeBnwD3u3IjEtRCL6f9D3DqN7uHpAJoNrEuBNXGZTa6jnkFUgc6wmLWMe4APiJOUdaCGIsYSdI6byefSmnv6KhJuVXGafI6lLY5lDJujiMeWLgy6GbMFOBXxPswMYK2FeRE8MKys/Fi7z0GvvrbbHsfPGD7mqHN71kwi1m0z969bo/18OvA8cAQxF24ChhN7ALars7+Yh/sdXuY6eSDwF+AyRG+E2K+opIPwZeBfXAdUGFgSwZkRDLQwOIS+Bi43Yq2XIyA+EPgxWw9QXycOEK7VgIDUP6/tOivxuyPkR9CGAS8h3oEMrfVaVWMMbXArYZOGfSurbJO1JgWZMRWVd14zYPCkcK7t89jg4SfWjdpr1bO7jrp32oa18yuC4HngRYx5HfgImG6tvXRiZbdyx7Inu6IbiaWhSp8vu3HIeI/vcioUoL6+mUb0nsMQa/cI4swgiMOJvn4GsY5XbuADC3s3jN2/8b0RYx+cOXzM83NG7HlNeNYlD1g4yMBSYt3sIvesYuqrANPJoVxSddLHEdeOclEt918Q0aZg6SiFiNvqTwgHVXD6pP2UAuoQz4Dfhla0PgzJQBSCnVBeVfHNnr0zsyfveeqo8oppKzKZb26MwlEpY7DWYiWgkUEm537GmLtP6VH9Rmb8wcNCeNY13Hf0a1/tSedKlK2iYgZcZ3czYsS8jOibamRoWRPd/6q/WET33Ftbb+ErS3Yfd9XbWzb9eUsUnZix9rCNUXjd69On1tojT11u4QKTPUhf9Dqv0PoCLPTuG4lwjHNd5y/yrtcJOADYr8i+yffseve5H/FW5AJn6J7zMRLFGo4YjXou96AZw7Rho830YaODq/r0b6zLNJ9WH0VPhtbWBEDKmMjCEmPMEhOrYy0BgADGTVu/5gO796QFEVwRxMZSsg0XJX53ORXLQVPAzxEjRmeaz6VCoJpYdOi53kAPV8jM54aOMsubm28sw0QGrDHGGmgswwydVjf31ld22/3FQDiJDuiR7liIAaOuof9GwHgaYrzNAZ5G9OAXEJBqvfU+ED8pbL0LTgfzJtcP5xBPYp802PAgkp/w02KeGxhjjDGhMaa/Mebnxhjc5w/AJCPtGItMuB8hjCUNpDAmDKDb9I3r/mL3mvhYBE+YbDehjttkYDQFqB/bigoBqK/M3wR8FRGVQY77tQHK8bTBm4Et7uJ5o8rK93GjaI0xKdffZQAWDv+PFUsJxQGutCuxatEepYDHEFfOTYh4nUg2F8nQ2merdT8PAcwWr7xiKI3Eyx9Dsopy9bNO7CnAvyLqRkWiz9ojLfMiYgPoesTpPxPRK+sRg/AbyBqs9dom547rP3vLph8jHoGQ7HqGiFpwTuJ5XUqFPNS3LJ9zxzJyzyYV6UcBxxBnqdcBGkrptTGKmlWEW2v95wA09EmlMDEYLRIG7EFhgxcBV7mO/Q7ZYFSXSZrWwPP10FnAw0BfZDIWyzl+iMT4x9Fan1Ug/Aj4HnH4t5DJl2wnxHrir5BgwV5IaLYWmIYsBkwj7r2LkMpYa23aQLQpis6tHz2+2sKvg7h+fn+cS2wUsxV90SEqdFaoPjkVyZBR8Z6LFGhT3FGB8LA7MenmNSsXdwuCJRnnm7TWZqwrz8LjB1d1J5CojFIhnaL1+TuS8HGr18aUd02A6KY3ESeG+DqWTsjPI5zoaGJu2hZpGRuBPwKX56i7cs7XgGuIdb+I4gZe+78K8RsD3ILo+q8AnwV2B/ZH1DHl5E8g6o1xflELsCrMnI+EZf36qlq3F8JstC+7lIp1M4EkyPq/c5UZIXrjN4jTwe6y8BcD1Y9vWHvRiLLyL/dLpVaVGZMOjAmwtgx4+OC6uT+8ZfWK6lC4jz6nEQFJW/VVgLyJ6F4jybbQ9ftP3PnvIil2/r0gnEy5xRCEM/UqoH90gjzl2ntCjj7W79cSc9JiwZns62pEQn2IcOR+rr+0XRGi7hzo/vt9yzljAgOsD8OTJ1RWzYskPOtHj7RNX/DGokupGIDq7H8R0a/UKGqr3NuAU5BBD4EzLdxr4Nyque9ed9GyRVM+aGr4wfowvD2C409eMl+t97MRT4ACZY3r9LYMCO3UjxFO4newitlfIbF4dYv5Yl6vnQ0cjwy6ZlIVYzA9gbjekpaxlv8sIm41utSRWPdmJEtME2QOd0eNLvmGj3LBD3SMjESfaLJ2j0cHj6gCZiW8JzqOk5FEmC5fs1WsX1GP1yKzLUX+zlWr/3HEAR66jrzUwrA0/N9ft2zu8fmP6547evFHt02qm/vSyjDTbMUlo1xaATQEWS5cX0Bdu9E6gVfLucsdVTz2dr/9Tt+MAOhAxJVWRvu6r7pyQDj4CXmuAfEiJJ9ZLPnPm4EEAqrzjIU+p6c7bkz8H0XArmVluwBzEgBV6u76tcupWJ1CXTgfAd92/+XjosoZyhGOew9xIsniDNxrH3nr9p7GTP1qj15rj63unTJi0U5FjBM/DAkSUeqX6Nzk80DEt+qWSat0g/tuETfMwERdQZJJQPI7T0D0SRXF+UiXoKwAPkFyYJP11BS8qd49KYqIw+d4JkiYuQcwhngBoO+O03pru3ol7rcA1tLL1V3vD717nwaWsB2SR4oBqAJG/Xf3ICJTkzByke9jvASxLB9BwmjHm3MOOGmjtV+8e9P6O17asPZ9K07q3olnaR2PRFwokNv1o9cdjQB0LjHAVT05ybv+a+6YnGAvec9oBv4N4art6b8ViB5YTpyP4Ou/IFKnL3GiiH60jsWMibbpBeA3wA1IQrduRqH6Zxli7D3p7hvv3e+EPNTbKIMAEdcGVUFuJ3YbdrnDfmuc0f4ucJci4uUockdKIHbwhshM/5z75Ot0vV4HwI9ilZOfdDIMQXTIrwN/9soNkM6ejHARDZ/6icuLEB0RYrdPA2LodffqkqtP0siKyhqys+9b6matHWSMmRZamwngg25B8EKTtYs3RdHSqiCYZq1diiEyhTNT7a8vAnci4DsOcf4Pdef+BlyATDIQC7+lTgaCAKhtalx3e//Br17/ybLPNVl7PsJx70eWMSuH76z1ZAVTsQD1E1gDxHA5AwHCocR+z1yNUK6nHMvPxPeXQCiH3oKIr8sQYBfTMTpY5yHuE83eSSGZ61oPX4UIEN13A7FT369fexQAqxAOCQLwluiL5FEbG1mbrg5SL0TYOx/buC51aFX3zO5lFaesCjOPB8bMtFgFdyEBAn9JzL8jAYl5iItpb9eHtcTjfC5iSPm5ngb4pNyYOVcPHMrgdNnj5y+re9QbozTbcROIreWgOrCaOX4CImbOIBZX+fII83W85oOmEa51IfAoEv24mcJXW0YIF3vD1Wss4iM8CeGCyXooiO5AJoROEr/uhUwOgxggakz4/leMMVFkbap7kHpw7ILZNyJ5qeMDWBnBZR+NGvfh2kzznZ5/stBn+okx04mlzlvE4G1CjMyfJu4XyWHMaxZWv71xXeri5Yv1Hn9MDNsBnNqJW0NJkG5Bdoz7OgIu5aK+jmVzlKEd0JJMiyz5OAgBZzkCrt/TetlCPjKuzEFIhvhcxG01GhF1/wv8A4nNzwR+i6gEVxEPrs811xKHXdtazdmEGCoLES79WcTbcTfwpLX2nbQxC2Y01P8Y+H0KjjIykcYaeHG/+bNf6yFiPumHbNlQgtaGmqbHabKOv8LT1//PRnTrPuQAv3FOegvm/kG7JXVjHavtkjDSkTVJSZCmEUv7D25gzkVcH/lIZ6VOkgXAD5ClH7rwTAfmEmTN0O4U5tj2OQDIIC5DjLBfkz1IPgdq4V4TFtbqJmKa2PszxMtgaS3u0ogkORcB5wLEVXU1LlR6YN3cwMoyjOOBfUInLSw0BVC+yUZHDEiXPbqhqXF8EKfpJRmIz/U1N6FlQV5i07PdXF0uRiJKfr21b1IIQ3jC/RfuUV7h90m+ccuFhW1CHV0054NUDYU6xHi6AeFMxyMZNUMRX1wZMgAbkQ1jpyGgfhHhxOp2UU6VRtwfFyAuGvVLFioCIRbZPnB9rq3XtADPA6dx9foiwmluIM55zSWBeiDidBgSTl0FpMZVVPJeYwPN1m7wrg0B62aR7fvhrNuv77vLfYdWde9VaYIBZcYMTsGQlDGDUjDOSI4AxphmRF/eH3hrxvAx611ZvRBgjkNClH4CSr5spGuJbYekpPP7ICC3qPcX4HX6XlCdsezYn5W68jKFLBF+2A2qQcRZH0QMNSOicy0xl8ulkGuZZchyiW8gBlAy8yYfJbPW/UiID96W53ncyO9oNbCeQ5ZI7IlMvKWujCjxHK13i2jev6LKHl7VPbh73eo3EJfPae58BeJjfATgltUr1iGRswXJxpzeo5op/QZp/sJbxphrgGPb6IvkxPT7oQwJjT7n2hZaMBMX1vqSxV8Q2VbUK5nQntSjtxqsnbX1jVZAK6pA1Y4JETCuI3uGJTmYDyC/TDWe7kKc4FsVG3abgrUV+cq61gOpz20jJFw4O8+9/kK5lvr9ZsNa/7rzEPF/NCJibzWw0kha4RgDuxnoYzDpwLA2jVnSPQjmDKzqXndA957hooZ63m1oeGpQOv2RMWZ3a22ziTek8lWnpFGpUqkMyUmY4q6JQmvNQdnbOiowFczjgAmILr8LYnDWA8sRT8F01y86htpXLS+mKGaslDp7bya/En7lIAar797wlyTnKsP/T7nU5YgLaTz5DRbbRlkFkwLaezWNv9jNX7Kbrw9ynVOV4T+R1a3VwJctnGcFBFVZl1toxEabwyi4d9Wyb927atkPvlrTt/LSmn6bM9Y+aKSMXGD0nxl612QQg/AO9zvqbgL7mY/nGxtLCm3rUESHPQcBZltkiQMxv0Skgq+ubRU37Yr0KV8/UatUvxdiHfpcLIXorl9y5STX0iS/d4pTecLCWiYsrLUeB9b17bnA2GpyhJLzmhSZAxC3zwokN3QiAk4tX7mXb8UPAHhow9pe+y+s/c57jQ0PG1EHUl5ebZKUmwWIOD8AAWcaiCqNse83NZg5TY1qQ6iBdhvi6biBGJx+nZJ1NIhLbwoC1JuJI2b+CuCixmRn2T/SD32mEbfPFWhkyWoqacu1ydWanUYOrLn2EA0SxxajpHcqpb+Vg/0/ZEnL5cSLA31dXDmPJlZneSU2RlFDANdduHzRngNS6f9xO1bkkiZNiC57D6IanYhEiNJAWAb2ltUrzFlLFyg4M+66t5B81cpE3fw6Jeuo9QuRiXY9Ivb3J1bRih6PrthhubNIQapi9j53ZGUmAwLavbxOCIjDe9vah9eM+IGriNWajHUW+22rV6rozCADdzOtRa+SnzuQ5DYtYtIK+L67KNN0RjnmSqztY2UJje/6+xABXD3ZS3cy1lpz1OJ5Zk0U+uA8CzFsdbmxPzkgVmnyRQv93IMMwlFfRVSEJ73nFKyTdnkCagfJb5jqstslBFdkfXVgvoeIzKQRCW1HypQD6aa0NcB7AQyJ4Kxlu+89aHFz009SxoQWUm5QFaQ/QRJj0l5Z5vLli3mjod6v2+mIuw+yE73bq1tbpPeFyCYTz1IkSIvloB12G3SQkq4fANbssY9d0NyUdKfo9S2GWme/XibhK816dmQtE/sNjMyMv+qAfIUYnH6/++KzAfEL/wVZG3UUraNHSsad+OHZSxccetcuu14UWnsAEGGMgj9CVKGeiG+6EQkO2O5BoADOIHH7B8kOvGj/KcfchLjYnnLnf0H7DM5PxHkYOATRTwtO2ysm3uuz9W3ilP0nIz8raxySG5DMiFIwNCAG012I9RsiqXPfIjaQkhx0NjDQofD7dux+j7+5pX562hi3wV/L0CoXm4VE5F4HTG1TQ+qIqh7c8Mmy8IH1a15BVgFoqh5k6/Q/R0LOmmc7FnEp5cNPMpyqdZiKZPYn/dN5qT0jyecQGjdP7sRWAmdrSg7c9xFw+u4WBedcJPfgaiSyltyErE2KIArgWjNnZnqXdPr6UMCZ8ax6FbH7IPrgQxb2PO/jumjovPczD6xf84UAjghkBxIFp4rgDUi49ArE21Dmldle+31caB2ORiKCtoAygLYB6vsvLeKk/Rkym84i5hBd+SFx3NrzbV3T0fr5fatboJ+WGBQF5/sI53qXeCl3sRNfQ6UP71/34d3lxrwQWZs2oo/6AFFV4TwD70wfNvqP7w4fe+qJ3Xu+HMExEdxphSuGAaRT0FhlzGeA5yZ371l1Uvee6kWB9v3PryKAzoWnr9N2knurTmyLlHPugYDzFUSRPg9JOs43EwoBQ/J8odf7uaPa+X7ShvGOuZ5BjjIKqVMhgCfHs77ijsmNzDYhS5tXEu8AvTUvOgiQvfpHrs0037NvdZ9zgDprbcrIq2r861rybY0xpzbZ6Mnb+g/+25JR4061Y/d76s+7jjw5BWMiOCOEY7ZY+zIQ7FdR1XBz/8GF5D8ocJ8hXhLk59tGSIDlWO+/Nstsb5WkzryDEP3hEXfP84lK5YumFBIhyvc7ec5XN3wjSTP1NxOLpgzibM4Qb7yQDLHqvToJC6lTvn5K/lYg9EVi9joY+swUkt0/ixicHfGopCxkAvisefcf79n9Dj1q2tpPZgXW9nD5pT4jSgFYa0NjjGm2dtjHmearPs40XzUwXVY/a8TYd2qC1BshzF3U3DS0Kgg+jqxNW2s/sIeftML8/ZlC6lOD6KzXIK4/f58uEInyXCFtbgugauGNRLK1+yCxYn0hQgbxl1W4BzUhXKGbG5jNSMx2ERLaG4RYkeXu2gZXRjWS8dMLAdoW4nS7Gq/cf0O4jXXl3ows73gI2THjQ0RkHoksUxiGZPasRvS/HyPb4CggRiHRkrQrT40T3cGkydV3gLu+mRh4A5AMqw3IQr6NSOb/KmJOFSFO6v6JAUohSdj3uX5OvsZwaykdiXi+0cx8bYkdd+Bh0zatfzOwtiIHSHFbDmGMsQFEWGustd02W3vIpig6BKAyCIisDTEmZeDcVcsXP1JgXVSq3ocYdsko0iFe29uk9haCGTfYtyJJDdcjsdnpyJqe3yJ7NV3uXaPZRt9CXBJ7IRbqcmTn3rXu9zUIAIciwLvMPfdHSGpbf8S5W48k/a4knlB3IBPhs8iLuAYiYbkTEPGyEhEjT7s2XIIsIQYBWo2r++OujGnIxDkHyVCahujZryKT6HnXtrcQF9BdyMK4KxGgPkYMTh9o+oYNPwEZZPeTpbS9bHtrKOVA+kvz/rRRB1Z1PySCTbb1Gn2fjBGRHxhjCIyJUsaEKdm7KTTGRK4xfYvQP7RNL5GtBmq/jCB75W5eag+gen4VsiHCVYg+urdr8NcQztYLAdGeyH5IIxDOtSeyRuYy4DMIiOqRcNt4hBM9jRhgQxDFehYSlVmHcL0UYt1CvM9lmTs+iHCxjxDQqY/uIGT2fuLqsYL4NTggPsHnEd/cQCRv0yLSYDGxO+Vid+3HrpxVrszH3fn17re+fSTpJ94t8VuPbyf6vzNBat3a8PMPWVj79qYoOhJrF5KdAN4WaWRLQ5japv6RLbiaiuU6srcX0rKqEYlcUGXyUa6ozR8RZ/NjxOlz44nzNBcjHGw2kn2+AlmrNB9ZXdgLEe2HEK9TH+IaUo2Ad6IrT/c2Sho8IbKE4SYE2JchQPkdwg3PRjh8OTI55ri6+O3dg3h9+h2IWpBBjMALEW7/U2SpSR3xBg8gE+NRRMVoRlSCfFTj1ds/LvcGrbPJII0pf72hnqMXffi2lQn7EnEySDHGmNa5X2CK1kDqEYxAdpJQijhrq0McVG/OIOB6CfHbnYcM6iOuAh8Qv+FjPJKgsAzhoHsjrpQPXcU2IBnnn0F2gdOXnkbeZwUiYjW64neWiqo+iH9urqvbPASc1yNLR8pduX8i3hJGaSMC0osRoF6HRDiOQXTnKmSyHenatJk4vlyBTIiD3DPa2u0kH8eqYNtTlAIuqulbvj4KP0HUnynEUa923yqSoP5bkbhRSbxRhMb1ldk1FVJAoc/0XTJXIiB4FhmAa5BXHT6JrDl/FRHdNyBgOxNRA65wndMP4VrHuXP17nina8z7CGB+hsSHR5K9u5xOnKnuew93LEMmyzvuOuPK+zytt9V+FNF1d0E2kZiAgLIeURP6IpGcxcjmFHshHLsaEfVfQnTRlxBj69dkk07sVYnnKo0sfqyLptUh8L/r10SX1fTTMfwe8LSFnxuY6Pa+DF3YqT2XY5+aVMEQ1fb3QtSjNWQv4dlIvItJm5OkvSeqKKhFkg60oTchbgSf1iNJuBMQA6YKUQV+7yr3IGIpr0G460+IOedvEGtf8yPVEPs2slw4OdCqHxuEw95OzGn1ml8gwF6FqBcQW+KvIQ7jAYhY92f0b4k343qYeNXnRwgXWEv8HqHTEOkw3+sv3wU2NzFg+azYbREurnUFm3JjojBOWpmOtQdjzIXGmCmhtbsaawmMiSzWgkklZK7+7JPqWaN/mHYqq6dXIJKmrZB4m+pGewDVAtXY0E5VXUZTuCLEUDgFAeBCYjGmFpyu015J9lKPwJ2zxHsL/Rfxeu4nctTH/55BuDbeb4iXCusWOH6HBO5Z2nG+6vCuV7a27VmyDaBPkInTiEiOpHGUNIb8t9eBJA0fjljzyYzzjpI+Y7qrSNRsrXH6YwZIpYKAnpXdfjm7ftNvDyuvPGNJc+P1W6wdI2zUgotCmWyu2us/F84pH5hKN60KM4W+diXpXsoVMGlzcrYH0GS2TjLUpXoZiEhXEd+TGNCaee5ntvgbAvjnlKNqvD9IPDfZGL9uyeSV5HuQ/Db5+ZbJRXp+koc+13cH6TndgzNN6/rp82a5zz6J9gXIaspTvOd11A/q98cSxFUGEB1YN9d67wcNz1m6IDW3qZE0TMpA37N71hz6uyEj9pvX1HDp+ig6NWNtt6xwmTEY6L5/RVW3keUVTau3FAzQQuucl9rTO3yO4IPSJs4ZRJw+gXDIebiXqHrX+a81THIa/S+57DUif2JKsm65ysx1v38+k+M+fyMv65WvdfNDfvmeDfGisd8lzilIT0b0eV2U1hk7x2m9/4joeS0MSJetAMxrarRpIG3Muym44dGN6+abOW8ft/v82TdviaKx+1dWndk/lb6/3Jj5gI2sxVpbUx2keg1NlxGYos15m+fTJeRzHl37EpCfrX8ayDc6hiAqgT8B/e8XuOvU96iq0e3uvEaxLOL1AHFfLctRpkUYw97uunyxbl/F+jZgA8gYuf8dxJd96EGV3XZbsfveo7eM2XfyzOFjrr1v4NCh/1rdmzJJH0w+13r1vN2Vne9dBiXaAcgHwXVkD6DPmS0SkNANZjWY8AOKA2izVxbE/uN8ANX/eyB+a4u8ltIG7oMYhK8ibkWIdemxlAC605MPAt14QnV2f1D191LEC6Kb3xbDQbWMD4j9jvnA6ZMC7liy94HSLdutAjYlhu8tSIh7MiWA7vTk59OC+EsVVPlAqp8lxGqBP/C5AKrnNiAuPmgd+26rfsrlr/Dq4oPPT1BPcv5tDtCdZdnxzki+ByGFGI6nIMBLxsXVS6BAHUK8z2hb5YMAbDOylHkG2S5A2879mpqYRvzS36T1Pq5+9EfB22W4KQF025KCQH3HbyEi8n1iIPkuKtUbbRvlKanFvgBZXDeVrVjW60jr90Nkhz590a7vavON4Lba69etw1QC6LYnn1OliNcg3enO+xwruSenHvW/5EZrDyNifTpbB07fb6wgfQTJlXiS1i9B81+u4O8U4+/xCiVc7ZSkg6c7coAk1jxEnIyS75PUQasREEE2iAoxjNqqm0YGFWCHI3kLG9upn340q0xfwtZhoJYsrK6l5JoqNTYGI9vSHIMM7kBkFYAh3kFuPsJ1pxKHR1V37dAOcl7doPXiPosk1RyBcP7RSMJPN+Jch1okdPw39zsZ+u1wpUrUdZQEgop/P9zZDQGobt+zmWwQ5gvvdlb9/GdA+7vT+ed0D6aOvkUvq+ASdT0lV4L6YPDj8vpduWWnDHyB9fOTaTQq5bug/HM2x7kSB/0no1zLl3Mlx3RZHLuN+vm0vepTohKVqEQlKlGJSlSiEpWoRCUqUYlKVKISFUL/H/k4626heD4bAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIxLTAzLTAyVDE0OjQ3OjUzKzAwOjAwSflWGgAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMS0wMy0wMlQxNDo0Nzo1MyswMDowMDik7qYAAAAZdEVYdFNvZnR3YXJlAEFkb2JlIEltYWdlUmVhZHlxyWU8AAAAAElFTkSuQmCC',
                          width: 70
                        },
                        {
                          alignment: 'left',
                          italics: true,
                          text: 'dataTables',
                          fontSize: 18,
                          margin: [10,0]
                        },
                        {
                          alignment: 'right',
                          fontSize: 8,
                          text: 'Speedy Porter company address phone no'
                        }
                      ],
                      margin: 20
                    }
                  });
                }
            }
        ]
    } );
} );
</script>

<script>
function actionFunction(){
$(".list-button").on("click", function (e) {
    var _this = this;
    var type = $(this).attr("data-tag");
    console.log(type);
    if (type === "edit") {
        window.location.href = $(this).attr("data-url");
    } else if (type === 'delete') {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this " + $(this).attr("data-title") + "!!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e91e63",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                $.get($(_this).attr("data-url"), function (data) {
                    if (data.success == false) {
                        showToastMessage('Error', data.message, 'error');
                    } else {
                        showToastMessage('Success', data.message, 'success');
                        window.location.reload();
                    }
                });
            } else {

            }
        });

    }
});
}
</script>
