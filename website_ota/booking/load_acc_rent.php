<?PHP
													$html .= '
															<tr class="gradeA">
																<td width="2%">&nbsp;</td>
																<td width="15%"><b>Nama Mobil</b></td>
																<td width="18%"><b>Harga Sewa</b></td>
																<td width="18%"><b>Include Supir & Tarif</b></td>
																<td width="8%" align="center"><b>Durasi Hari</b></td>
																<td width="8%" align="center"><b>Qty</b></td>
																<td align="center" width="15%"><b>Disc ('.groupBerlangganan($conn, $QryCekPesanan['kar_id'], "kategori_agent").')</b></td>
																<td width="18%" style="border-right: 1px solid" ><b>Total Stlh Disc</b></td>
															</tr>
															
															';
														$qryItem = "SELECT a.book_id,b.rent_merk,a.check_in,a.check_out,b.hotel_nama,b.hotel_avg,b.rent_harga_supir,a.flag_supir,a.rinci_detail_qty,a.rinci_detail_disc,a.rinci_detail_penawaran FROM guest_book a INNER JOIN m_hotel b ON a.hotel_id = b.hotel_id WHERE a.rinci_id = '".$spec."' AND a.kategory_item = '".$kode_kategory."'";
														$stmtItem 	= $conn->prepare( $qryItem );
														$stmtItem->execute();
														while ($rowItem = $stmtItem->fetch(PDO::FETCH_ASSOC)){
														extract($rowItem);
															if($flag_supir == 1){
																$withDrive = 'Ya';
																$tarif = $rent_harga_supir;
															}else{
																$withDrive = 'Tidak';
																$tarif = 0;
															}
															
															$in		 = date_create($check_in);
															$out	 = date_create($check_out);
															$tot_day = date_diff($in,$out);
														
														$i++;	
														$html .= '
															<tr class="gradeA">
																<td width="2%">&nbsp;</td>
																<td>'.$rent_merk.' '.$hotel_nama.'</td>
																<td align="right">Rp. '.number_format($hotel_avg,2,",",".").'</td>
																<td valign="top">'.$withDrive.' ('.number_format($tarif,2,",",".").')</td>
																<td align="center">'.$tot_day->format("%a").'</td>
																<td align="center">'.$rinci_detail_qty.'</td>
																<td align="right">Rp. '.number_format(groupBerlangganan($conn, $QryCekPesanan['kar_id'], "potongan") * $tot_day->format("%a"),2,",",".").'</td>
																<td align="right" style="border-right: 1px solid">Rp. '.number_format($rinci_detail_penawaran,2,",",".").'</td>
															</tr>
															
															';
														}
?>