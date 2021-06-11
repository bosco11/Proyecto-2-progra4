<div id="panel_app">
    <div class="box-header">
        <h2 class="box-title">Ruleta de la suerte</h2>
        <?php if ($seccion == TRUE) { ?>
            <?php
            if ($this->session->userdata['logged_in']['tipo'] == 'Tienda') { ?>
                <?php echo form_open('tienda/tiendaHome'); ?>
                <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
                <?php echo form_close(); ?>
            <?php  } else { ?>
                <?php echo form_open('comprador/compradorHome'); ?>
                <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
                <?php echo form_close(); ?>
            <?php } ?>
        <?php } else { ?>
            <?php echo form_open('comprador/compradorHome'); ?>
            <button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
            <?php echo form_close(); ?>
        <?php } ?>
    </div>
    <br>
    <div style="text-align: center;">
        <!-- <input type="button" value="spin" id='spin' class="btn btn-primary" /> -->
        <button type="button" style="float:left; margin-left: 30px;" value="spin" id='spin' class="btn btn-primary">Girar la ruleta</button>
        <canvas id="canvas" width="600" height="600"></canvas>
        <div id="cen-ruleta">
            <img style="position: absolute; left: 2px;bottom: 2px;" id="item-display" src='<?php echo site_url('/resources/img/ruleta.png') ?>'>
        </div>
    </div>
    <br>
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="color: black;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Premio otorgado</h5>
                    <button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="color: black;">
                    <h3>Premio:</h3><label for="" id="nota" style="font-size: 30;font-weight: bold;"></label>
                    <select disabled name="cmb_tarjetas" id="cmb_tarjetas" class="form-select form-select-sm me-2" aria-label=".form-select-sm example">
                        <option value="">Sin seleccionar</option>
                        <option value="">Sin seleccionar</option>
                        <option value="">Sin seleccionar</option>
                        <option value="">Sin seleccionar</option>
                        <!-- <?php if (!empty($categorias)) { ?>
								<?php foreach ($categorias as $cate) { ?>
									<option value="<?php echo $cate['id_categorias'] ?>"><?php echo $cate['categorias'] ?></option>
								<?php } ?>
							<?php } ?> -->
                    </select>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" id="premio" name="premio">
                    <!-- <button type="button" class="btn btn-secondary" onclick="closeModal()" data-dismiss="modal">Close</button> -->
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    var options = ["$50", "Envío", "%10", "Nada", "$50", "Envío", "%10", "Nada", "$50", "Envío", "%10", "Nada", "$50", "Envío", "%10", "Nada", "$50", "Envío", "%10", "Nada"];

    var startAngle = 0;
    var arc = Math.PI / (options.length / 2);
    var spinTimeout = null;

    var spinArcStart = 10;
    var spinTime = 0;
    var spinTimeTotal = 0;

    var ctx;

    document.getElementById("spin").addEventListener("click", spin);

    function byte2Hex(n) {
        var nybHexString = "0123456789ABCDEF";
        return String(nybHexString.substr((n >> 4) & 0x0F, 1)) + nybHexString.substr(n & 0x0F, 1);
    }

    function RGB2Color(r, g, b) {
        return '#' + byte2Hex(r) + byte2Hex(g) + byte2Hex(b);
    }

    function getColor(item, maxitem) {
        var phase = 0;
        var center = 128;
        var width = 127;
        var frequency = Math.PI * 2 / maxitem;

        red = Math.sin(frequency * item + 2 + phase) * width + center;
        green = Math.sin(frequency * item + 0 + phase) * width + center;
        blue = Math.sin(frequency * item + 4 + phase) * width + center;

        return RGB2Color(red, green, blue);
    }

    function drawRouletteWheel() {
        var canvas = document.getElementById("canvas");
        if (canvas.getContext) {
            var outsideRadius = 200;
            var textRadius = 160;
            var insideRadius = 125;

            ctx = canvas.getContext("2d");
            ctx.clearRect(0, 0, 500, 500);

            ctx.strokeStyle = "black";
            ctx.lineWidth = 4;

            ctx.font = 'bold 12px Helvetica, Arial';

            for (var i = 0; i < options.length; i++) {
                var angle = startAngle + i * arc;
                //ctx.fillStyle = colors[i];
                ctx.fillStyle = getColor(i, options.length);

                ctx.beginPath();
                ctx.arc(250, 250, outsideRadius, angle, angle + arc, false);
                ctx.arc(250, 250, insideRadius, angle + arc, angle, true);
                ctx.stroke();
                ctx.fill();

                ctx.save();
                ctx.shadowOffsetX = -1;
                ctx.shadowOffsetY = -1;
                ctx.shadowBlur = 0;
                ctx.shadowColor = "rgb(220,220,220)";
                ctx.fillStyle = "black";
                ctx.translate(250 + Math.cos(angle + arc / 2) * textRadius,
                    250 + Math.sin(angle + arc / 2) * textRadius);
                ctx.rotate(angle + arc / 2 + Math.PI / 2);
                var text = options[i];
                ctx.fillText(text, -ctx.measureText(text).width / 2, 0);
                ctx.restore();
            }

            //Arrow
            ctx.fillStyle = "white";
            ctx.beginPath();
            ctx.moveTo(250 - 4, 250 - (outsideRadius + 5));
            ctx.lineTo(250 + 4, 250 - (outsideRadius + 5));
            ctx.lineTo(250 + 4, 250 - (outsideRadius - 5));
            ctx.lineTo(250 + 9, 250 - (outsideRadius - 5));
            ctx.lineTo(250 + 0, 250 - (outsideRadius - 13));
            ctx.lineTo(250 - 9, 250 - (outsideRadius - 5));
            ctx.lineTo(250 - 4, 250 - (outsideRadius - 5));
            ctx.lineTo(250 - 4, 250 - (outsideRadius + 5));
            ctx.fill();
        }
    }

    function spin() {
        spinAngleStart = Math.random() * 10 + 10;
        spinTime = 0;
        spinTimeTotal = Math.random() * 3 + 16 * 1000;
        rotateWheel();
    }

    function rotateWheel() {
        spinTime += 30;
        if (spinTime >= spinTimeTotal) {
            stopRotateWheel();
            return;
        }
        var spinAngle = spinAngleStart - easeOut(spinTime, 0, spinAngleStart, spinTimeTotal);
        startAngle += (spinAngle * Math.PI / 180);
        drawRouletteWheel();
        spinTimeout = setTimeout('rotateWheel()', 30);
    }

    function stopRotateWheel() {
        clearTimeout(spinTimeout);
        var degrees = startAngle * 180 / Math.PI + 90;
        var arcd = arc * 180 / Math.PI;
        var index = Math.floor((360 - degrees % 360) / arcd);
        ctx.save();
        ctx.font = 'bold 30px Helvetica, Arial';
        var text = options[index]
        ctx.fillText(text, 250 - ctx.measureText(text).width / 2, 250 + 10);
        ctx.restore();
        document.getElementById('nota').innerHTML = text;
        document.getElementById('premio').value = text;
        if (text == "$50") {          
            $('#cmb_tarjetas').prop('disabled', false);
            document.getElementById('cmb_tarjetas').style.display = "block";

        } else {
            $('#cmb_tarjetas').prop('disabled', true);
            document.getElementById('cmb_tarjetas').style.display = "none";
        }
        $('#exampleModalCenter').modal('show');
    }

    function easeOut(t, b, c, d) {
        var ts = (t /= d) * t;
        var tc = ts * t;
        return b + c * (tc + -3 * ts + 3 * t);
    }

    function closeModal() {
        $('#exampleModalCenter').modal('hide');
        drawRouletteWheel();
    }

    drawRouletteWheel();
</script>