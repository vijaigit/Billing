<table bgcolor="#A5C3EF" cellpadding="0" cellspacing="0" border="2px" align="center" >
    <tr>
        <td align="center" colspan="6" rowspan="2" valign="middle">
            <font size="3" face="Arial" color="#53585F">
            <b>
                <?php echo get_hotelname(); ?>
            </b>
            </font>
        </td>
    </tr>	
</table>
<table cellpadding="0" cellspacing="0" border="2px" align="center" width="100%">
    <thead>
        <tr bgcolor="#A5C3EF">
            <th align="center"  valign="middle" width="30px">
                <font size="2" face="Arial" color="#53585F">
                <b>
                    S.No.
                </b>
                </font>
            </th>
            <th align="center"  valign="middle" width="50px">
                <font size="2" face="Arial" color="#53585F">
                <b>
                    Item Name
                </b>
                </font>
            </th>
            <th align="center" valign="middle" width="50px">
                <font size="2" face="Arial" color="#53585F">
                <b>
                    Price
                </b>
                </font>
            </th>
            <th align="center"   valign="middle" width="50px">
                <font size="2" face="Arial" color="#53585F">
                <b>
                    Quantity
                </b>
                </font>
            </th>
            <th align="center"   valign="middle" width="50px">
                <font size="2" face="Arial" color="#53585F">
                <b>
                    Date
                </b>
                </font>
            </th>
            <th align="center"   valign="middle" width="50px">
                <font size="2" face="Arial" color="#53585F">
                <b>
                    Total
                </b>
                </font>
            </th>
        </tr>
    </thead>
    <tbody>

        <?php $total = 0; foreach ($value as $key => $row) { ?>		
            <tr>	
                <td align="center" valign="middle" width="30px">
                    <font size="2" face="Arial" color="#53585F">
                    <?php echo $key + 1; ?>
                    </font>
                </td>
                <td align="left"  valign="middle" width="50px">
                    <font size="2" face="Arial" color="#53585F">
                    <?php echo $row['productName']; ?>
                    </font>
                </td>
                <td align="left"  valign="middle" width="50px">
                    <font size="2" face="Arial" color="#53585F">
                    <?php echo $row['price']; ?>
                    </font>
                </td>
                 <td align="left"  valign="middle" width="50px">
                    <font size="2" face="Arial" color="#53585F">
                    <?php echo $row['quantity']; ?>
                    </font>
                </td>
                 <td align="left"  valign="middle" width="50px">
                    <font size="2" face="Arial" color="#53585F">
                    <?php echo $row['date']; ?>
                    </font>
                </td>
                <td align="left"  valign="middle" width="50px">
                    <font size="2" face="Arial" color="#53585F">
                    <?php echo $row['total'];  $total += $row['total']; ?>
                    </font>
                </td>
            </tr><?php } ?>
        <tr>
            <td colspan="5">
                <font size="2" face="Arial" color="#53585F">
                <?php echo "<b>Total</b> = "; echo $total != 0?$total:''; ?>
                </font>
            </td>
        </tr>
    </tbody>

</table>
