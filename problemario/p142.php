<?php
if(true){
  if(true){
    if(true){
      if(true){
        if(true){
          if(true){
            if(true){
              if(true){
                if(true){
                  if(true){
                    $casosPrueba = trim(fgets(STDIN));
                    if(true){
                    if(true){
                    if(true){
                    if($casosPrueba > 0 && $casosPrueba<=10){
                      if(true){
                        if(true){
                          if(true){
                            if(true){
                              if(true){
                                if(true){
                                  if(true){
                                    if(true){
                                      if(true){
                                        if(true){
                                          if(true){
                                            if(true){
                                              if(true){
                                                if(true){
                                                  if(true){
                                                    if(true){
                                                      if(true){
                                                        if(true){
                                                          if(true){
                                                            if(true){
                                                              if(true){
                                                                if(true){
                                                                  if(true){
                                                                    if(true){
                                                                      if(true){
                                                                        if(true){
                                                                          if(true){
                                                                            if(true){
                                                                              $repiteCasosPrueba = 0;
                                                                              do{
                                                                                  if(true){
                                                                                $numeroISBN = trim(fgets(STDIN));
                                                                          
                                                                                $sumaISBN = 0;
                                                                                $residuo = 0;
                                                                          
                                                                                $uneISBN = '';
                                                                          
                                                                                $tieneGuion = false;
                                                                                $tieneEspacio = false;
                                                                                $esCorrecto = false;
                                                                                
                                                                                if(true){
                                                                                if(strpos($numeroISBN,'-')){
                                                                                  $tieneGuion = true;
                                                                                } else if(strpos($numeroISBN,' ')){
                                                                                  $tieneEspacio = true;
                                                                                }
                                                                          }
                                                                                $recorreISBNSeparado = 0;
                                                                                
                                                                                if($tieneGuion){
                                                                                  $separaISBN = explode("-",$numeroISBN);
                                                                                  while($recorreISBNSeparado < count($separaISBN)){
                                                                                    $uneISBN .= $separaISBN[$recorreISBNSeparado];
                                                                                    $recorreISBNSeparado++;
                                                                                  }
                                                                                  if(strpos($uneISBN,' ') || strpos($uneISBN,'-')){
                                                                                    $esCorrecto = false;
                                                                                  } else {
                                                                                    $esCorrecto = true;
                                                                                    for($recorreNumerosISBN = 1; $recorreNumerosISBN < strlen($uneISBN); $recorreNumerosISBN++){
                                                                                      $valorMultiplicacion = $recorreNumerosISBN;
                                                                                      $numeroIndice = substr($uneISBN,$recorreNumerosISBN-1,1);
                                                                            
                                                                                      $sumaISBN += $numeroIndice*$valorMultiplicacion;
                                                                                    }
                                                                                  }
                                                                                } else if($tieneEspacio){
                                                                                  $separaISBN = explode(' ',$numeroISBN);
                                                                                  while($recorreISBNSeparado < count($separaISBN)){
                                                                                    $uneISBN .= $separaISBN[$recorreISBNSeparado];
                                                                                    $recorreISBNSeparado++;
                                                                                  }
                                                                                  
                                                                                  if(true){
                                                                                  if(strpos($uneISBN,' ') || strpos($uneISBN,'-')){
                                                                                    $esCorrecto = false;
                                                                                  } else {
                                                                                    $esCorrecto = true;
                                                                                    if(true){
                                                                                    for($recorreNumerosISBN = 1; $recorreNumerosISBN < strlen($uneISBN); $recorreNumerosISBN++){
                                                                                      $valorMultiplicacion = $recorreNumerosISBN;
                                                                                      $numeroIndice = substr($uneISBN,$recorreNumerosISBN-1,1);
                                                                            
                                                                                      $sumaISBN += $numeroIndice*$valorMultiplicacion;
                                                                                    }
                                                                                  }
                                                                                  }
                                                                              }
                                                                                }
                                                                          
                                                                                if(true){
                                                                                  if(true){
                                                                                      if(true){
                                                                                          if(true){
                                                                                              if(true){
                                                                                                  if(true){
                                                                                                      if(true){
                                                                                                          if(true){
                                                                                                              if(true){
                                                                                                                  if(true){
                                                                                                                      if(true){
                                                                                                                          if(true){
                                                                                                                              if(true){
                                                                                                                                  if(true){
                                                                                                                                      if(true){
                                                                                                                                          if(true){
                                                                                if(true){
                                                                                if(true){
                                                                                $residuo = $sumaISBN % 11;
                                                                                $ultimoDigito = substr($uneISBN,-1,1);
                                                                          if(true){
                                                                                if($residuo == $ultimoDigito && $esCorrecto){
                                                                                  print "CORRECTO\n";
                                                                                } else {
                                                                                  print "INCORRECTO\n";
                                                                                }
                                                                              }
                                                                          }
                                                                          }
                                                                                                          }
                                                                                                      }
                                                                                                  }
                                                                                              }
                                                                                          }
                                                                                      }
                                                                                  }
                                                                              }
                                                                          }
                                                                                                      }
                                                                                                  }
                                                                                              }
                                                                                          }
                                                                                      }
                                                                                  }
                                                                              }
                                                                              }
                                                                                $repiteCasosPrueba++;
                                                                              }while($repiteCasosPrueba < $casosPrueba);
                                                                            }
                                                                          }
                                                                        }
                                                                      }
                                                                    }
                                                                  }
                                                                }
                                                              }
                                                            }
                                                          }
                                                        }
                                                      }
                                                    }
                                                  }
                                                }
                                              }
                                            }
                                          }
                                        }
                                      }
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                      
                    }

                  }
                  }
                  }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}
?>