function beep() {
				var snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");  
				snd.play();
			}
			
			function beepError() {
				var snd = new Audio("data:audio/wav;base64,UklGRnBbAABXQVZFZm10IBAAAAABAAEARKwAAIhYAQACABAAZGF0YUxbAAAAWgBa/1MCVP5OAU8BSf1IBEX8PwNA/jsBPAA4ADj/MwEw/y8CLf4sASn/KAEmACMAIwAg/x8BHgAe/xoCGf4YARb/FQEU/xMCEv4OAQ//DAENAAsAC/8JAgj+BwIG/gUBBAAEAAMAAwABAAD//wL//v4B/gD+APwA+wD7APoA+gH4/vcC9/71A/b99AP1/fMD9P3xAvH/8AHw/+8B7/7uAu7/7ADtAO0A7QDsAOwA6wDq/+kC6f7oAegA6P/mAecA5wDmAOb/5AHlAOQA5ADkAOMA4wDiAOIA4v/hA+H83wPg/9//3wLf/t4B3wHe/d0E3fzcA93+3AHcANwA3P/aAdv/2gHbANr/2QHa/9gC2f3YA9n91wPY/tcB1//WAdcA1//WAdf/1QHWANb/1ALV/tQB1QDUANT/0wPU/NME0/3SAdMB0//SANIA0gHS/tED0f3QAtEA0f/QANAB0P/PAdAA0P/PAdD/zgHP/84Bz//OAc4Azv/NAc7/zQDOAs3+zAHN/8wAzQLN/cwDzP3LA8z9ywPM/ssAzALL/coCywDL/8oBy//KAcr+yQPK/skAygHK/8kAyQHJ/sgCyf/IAMkAyQDI/8cCyP7HAsj+xwHI/8cCyP7GAsf9xgTH+8YGx/rGBsf6xQXG/cUBxgDGAMYAxgDGAMb/xAHFAMX/xALF/sQCxf7EAcUAxQDFAMQBxP7DAsT9wwTE/cMCxP7DAcT/wgLD/sICw/7CAcMAw//CAsP+wgLD/sICw/7BAsL+wQLC/sECwv7BAsL+wQLC/sACwf7AAsH+wAPB/cACwf7AA8H9wAPB/cACwf+/AcD/vwDAAcD+vwPA/r8AwAHA/78AwAHA/78AvwK//L4Ev/2+A7/+vgC/Ab//vgG/AL/+vgO//b4Dv/29Ar7/vQC+Ab7/vQC+Ab7+vQK+/70Bvv+9Ab7+vQO+/bwDvf68Ab3/vAG9/7wBvQC9/7wCvf28A73+vAG9AL0Avf+8Ab3/uwG8ALz/uwC8Abz/uwG8ALz/uwG8/7sBvP+7Arz9uwK8ALz/uwG8/7oAuwK7/roBuwC7/7oCu/66AbsAuwC7ALsAu/+6AbsAu/+6Arv9ugO7/rkBuv+5Arr+uQG6ALr/uQK6/rkCuv65Arr9uQO6/7kAugG6/bkEuvy5BLr9uQK6/rgCuf64Arn/uAC5Abn+uAK5/rgCuQC5/rgCuf64Arn/uAC5Abn/uAC5Abn+uAO5/rgBuf64A7j9twK4ALj+twO4/LcEuPy3BLj9twG4ALj/twK4/7cAuAC4/7cDuP23Arj/t/+3A7j8twW4+rcFuP23AbcBt/62Arf+tgK3/rYBtwC3ALcAtwC3/7YBtwC3/7YBt/+2Abf/tgG3/7YBt/+2ALcBt/+2Abf/tgG3/7YAtwG3/7UCtv21A7b9tQO2/rUCtv61AbYAtgC2ALb/tQK2/bUEtvy1A7b+tQC2AbYAtv+1Arb9tQO2/rUAtgK2/rUCtv61AbYBtv61Arb+tQK2/7QAtQC1ALUAtQC1/7QCtf+0ALUAtQC1/7QDtfy0BLX9tAK1/rQCtf+0ALUBtf60A7X+tAC1ALUBtf+0AbX/tAC1AbX/tAG1/7QBtQC1/rQDtf20ArQAtP+zAbT+swO0/bMDtP6zAbT/swK0/bMEtPuzBbT9swG0ALT/swC0AbQAtP9ZAVr/UwBUAU/+SANJ/UQDRfw/BED9OwI4/zcANAE0/i8DMPwsBSn7KAMm/yUAIwEj/x8AHgAeABsAGwAZARn/FQAUART+EQMS/Q4DD/0MAwv9CgMK/QkDCP0HAwb9BQME/QICAwAB/gADAP3/Av///QD+Afz++wL7//r/+QP4/PcD9//2APYA9gD1APT/8wPy/fEC8f/w/+8C7//uAO4B7v7sAu3+7AHsAez+6gLr/ukB6gDpAOkA6P/mAecA5wDn/+UB5gDl/+MC5P3jA+T/4v/iAuL94QPi/uAB4f/fAuD+3wHf/94B3wDfAd7+3QHdAN0A3QHc/tsC3P7bAtv/2gDbANoA2gDaANoA2QDZAdn+1wLY/tcD2P3WAtf/1gHX/9YC1vzVBNb+1QHVANX/1ADUAdT/0wHU/9MA0wHT/tIC0//SANMB0v/RANIB0f/QAdEA0f/QAdD/zwHQAND/zwHQ/88Bz//OAc/+zgPP/s4AzgHO/80AzgLO/MwEzf7MAM0Bzf7MAs3/ywDMAMwAzADMAMwAzADLAMv/ygLL/soBywHL/ckEyvzJAsoAyv/JAsr+yAHJ/8gByQDJAMkAyf/HAsj9xwPI/scCyP3HA8j9xwPH/sYAxwHH/8YCx/3GAscAx//FAcb/xQHG/8UCxv3FAsYAxv7EA8X9xAPF/sQBxf/EAcUAxf/EAsT+wwHEAMT+wwTE/MMCxADE/sMExPzCA8P+wgHD/8ICw/7CAcMAw//CAcMAw//BAcIAwv/BAcIAwv/BAcIAwv/BAsL9wAPB/sACwf/AAMEAwQDBAcH/wAHB/8AAwQHB/78BwP+/AcD/vwHAAMAAwP+/AsD9vwTA/L8DwP6+Ab//vgG//74Cv/2+A7/9vgO//r4Bv/++Ab//vgK//b0Cvv+9AL4Cvv29Ab4Bvv69A779vQK+/r0Dvv29A739vAK9/7wAvQG9/7wAvQG9/7wAvQC9AL0AvQC9AL0AvQC9AL3/vAK8/bsEvPy7BLz8uwO8/rsBvAC8/7sBvAC8/7sBvP67A7z+uwG8/7oAuwG7/7oBu/+6Abv/ugG7/7oBu/+6Abv/ugG7/7oAuwG7/7oBu/66Arr/uQC6Arr8uQS6/bkCuv+5ALoAugC6ALoAugG6/7n/uQK6/rkDuv25Arr+uQO6/LkEuf24Arn/uAC5Abn+uAO5/bgDuf64ALkBuf+4Abn/uAG5/7gBuf+4Abn+uAO5/bgDuf64Abj/twC4Arj9twO4/rcAuAG4/7cAuAG4/rcCuP63Arj+twK4/rcBuAG4/rcCuP63AbgAuAC4ALgAuP+3AbcAtwC3/7YBt/+2AbcAtwC3/7YBt/+2AbcAtwG3/LYGt/q2BLcAt/y2Brf7tgK3ALf/tgG3ALf/tgG3/7YBtwC3/7YBtv+1AbYAtv+1Abb/tQG2/7UBtv+1Abb/tQG2/7UBtgC2/7UBtv+1Arb9tQO2/bUDtv61Abb/tQC2Arb9tQO2/rUBtv+1Abb/tQG2ALX/tAG1/7QAtQG1ALX+tAO1/bQCtQC1/rQCtQC1/rQDtf20ArX/tAC1AbX/tAG1/7QAtQG1ALX+tAO1/LQEtf60ALUAtQC1ALUAtQG1/rQCtf60AbUAtP+zArT9swO0/rMBtP+zAbT/swG0ALT+swO0/rMAtAG0/7MAtAG0/7MAtAK0/VkCVP9TAE8BT/9IAUn+RAJA/j8DPP07Ajj+NwI0/y8BMP8sAC0AKQApASb/IgAjACAAIAAeAR7+GgIZ/xgAFgEW/hMDFP0RAw/9DgIN/wwBCwAL/gkCCv8HAAYCBvwDBQT8AgID/wAAAAEA//4A/wD+Af79+wT7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/tYC1/7WAtb+1QHW/9QC1f/UANUA1ADUANQA1AHU/tID0/zSBNP80gTS/NEE0vzRA9H/0P/QAtH+0AHQAdD+zwLQ/s8C0P7PAs//zgDPAM8Bz/7NA878zQTO/M0Ezv3MAs3/zADN/8wCzf7MAsz/ywDMAMz/ywLM/ssCy/7KAsv+ygLL/coEy/zJBMr8yQPK/8n/yQLK/cgDyf7IAckAyf/IAcn/xwHIAMj/xwHI/8cByADI/8cBxwDH/sYEx/vGBMf+xgHH/8UBxv/FAcb/xQDGAsb+xQLG/sQAxQLF/sQCxf7EAsX+xALF/cQDxf7DAsT+wwLE/cMExPzDA8T/w//DAsP+wgHDAMP/wgHDAMP/wgHD/sIDw/3CA8P9wQLCAML/wQHC/8EBwgDC/8EBwv/AAcEAwf/AAMEBwf7ABMH7wATB/cACwf/AAcH+vwPA/L8FwPy/AsD/vwHAAMD/vwHA/78BwP+/Ab8Av/++Ab//vgG/AL8Av/++Ar/+vgK//r4Cv/2+BL/9vQG+AL7/vQK+/r0Cvv29A77+vQG+Ab7+vQK+/r0Cvv68Ar3/vAC9Ab3+vAG9Ab3+vAK9/7wAvQC9AL0Bvf+8AL0AvQC9Abz/u/+7Arz+uwK8/7sAvAC8/7sCvP+7ALwAvAC8ALwAvAC8/7sCvP66Arv9ugO7/boDu/66AbsAu/+6Abv/ugG7/7oBu/+6Abv/ugG7/7oBu/+5Abr/uQG6/7kBuv65A7r8uQS6/bkBugC6ALoAugC6/7kCuv65Arr+uQG6ALr/uQG5ALn/uAK5/bgDuf64Abn/uAG5ALkAuf+4Abn/uAK5/rgBuQC5/7gDufy4A7n+uAG5Abn+uAK4/rcCuP63Arj+twK4/rcCuP63Arj+twG4ALgAuP+3Arj+twG4ALj+twO4/rcBuAC4/7cAuAG4/7cBuP+2Abf+tgO3/bYCtwC3/rYDt/y2BLf+tgC3Abf+tgK3/7YAtwC3ALcBt/62Arf/tgC3Abf+tgO3/bYDt/y2Bbf7tgW2+7UDtgC2/bUEtvy1A7b/tf+1Arb9tQO2/rUBtgC2/7UCtv61Arb9tQO2/rUCtv61AbYAtgC2ALYAtv+1AbYAtgC2ALb/tQG2/7UCtv20A7X+tAG1ALX/tAK1/bQDtf20A7X+tAC1ALUBtf60A7X8tAS1/LQEtfy0BLX8tAO1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/scCyP3HBMj9xwHIAcj9xwXH+8YEx/3GAccCx/3GA8f+xQDGAcb/xQDGAsb9xQPG/cUCxf/EAMUBxf/EAMUBxf7EA8X9xALF/8MAxALE/MMFxPvDBMT+wwDEAcT/wgHD/8IBw/7CA8P+wgHD/8IBw//CAcMAw/7BBML8wQPC/cEDwv7BAsL+wQDCAsH+wALB/sAAwQLB/sACwf7AAMECwf7AAcEBwf2/BMD8vwPA/78AwADA/78CwP6/AsD+vwHA/78Cv/6+Ab8Av/++Ab8Bv/y+Br/6vgW//L4CvwC/AL8Av/+9Ab4AvgC+AL7/vQG+Ab79vQS+/L0Dvv69Ab4AvgC+AL0AvQC9AL0Bvf68Ar0Avf68A739vAO9/rwBvQC9/7wCvf68Ab0BvP67Arz+uwG8Abz/uwC8ALwAvAC8Abz9uwO8/rsBvAC8/7sBvP+7Abv/ugG7/7oBuwC7/7oCu/26A7v+ugG7ALsAu/+6Arv+ugG7ALv/ugK7/rkCuv25A7r+uQG6/7kBuv+5Arr9uQK6/7kAugK6/rkBuv+5ALoBugC6/7kBuv+5AbkAuf+4Arn9uAS5/LgDuf+4/7gDufu4Bbn8uAK5ALn/uAG5/7gAuQG5ALkAuf+4Abn/uAK5/rcCuP63Arj9twO4/rcCuP63Abj/twG4ALj/twK4/bcDuP63AbgAuP+3Abj/twK4/bcDuP23A7j9twK4/7YBtwC3/7YAtwG3/7YCt/22A7f+tgG3ALf/tgG3ALcAtwC3ALf/tgG3ALcAt/+2Arf9tgO3/rYBtwG3/bYDt/22A7b+tQG2/7UBtv+1ALYBtv+1Abb/tQC2Abb/tQG2/7UBtv+1Abb/tQG2/7UAtgG2/7UAtgC2ALYBtv61Arb+tQK2ALb+tQK2/rUCtv61ArX/tP+0ArX9tAO1/7T/tAK1/rQBtQC1ALUAtQC1ALUAtQC1ALUAtQC1ALUAtQC1ALUAtf+0ArX+tAO1/LQDtf60A7X9tAK1/7T/tAO1/LQEtfy0A7T+swG0/7MCtP2zA7T9swK0ALT+swO0/LMFtPyzAbQBtP2zBbT7swS0/bMCtP9ZAFoAVAFU/04BSf5IA0X9RANA/T8CPP83ATj/MwA0ATD/LwAtACkAKQEm/yUAIwAjACAAHgEe/xoAGwEZ/hgCFgAU/hMDEvwRBA/9DgIN/wwACwEK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Atz+2gHbANv/2QHaANr/2QHZ/9gB2f/XAdj/1wHY/9YB1//WANcC1/3VA9b91QLW/9QB1f/UANQA1AHU/9MB1P/SANMB0//SANMB0//RAdL/0QDRANEC0f3QA9H9zwLQAND/zwHQ/88B0P/PAc/+zgPP/s4Bz//NAM4Bzv/NAc7/zAHN/8wBzf7MA839zAPM/csCzP/LAcwAzP/LAMsBywDLAMv/ygHL/8oCyv/J/8kCyv3JBMr8yQTJ/MgDyf/I/8gCyf7IAsj+xwLI/scDyPzHA8j+xwHIAsf7xgXH/MYDx/7GAsf9xgPH/sUBxgDG/8UBxv/FAcb/xQDGAcX/xADFAMUAxQDFAMUBxf7EAsX+wwLE/sMCxP/D/8MDxPzDA8T/w//DAsP+wgHDAcP9wgTD+8IFw/3CAcMAw//CAsL/wf/BAsL+wQHCAMIAwv/BAsL9wQLBAMH/wAHB/8ABwf7AAsEAwf/AAcH/wADBAcEAwP+/AcD/vwHA/78BwADA/78BwP+/AMACwP2/Ar//vgC/Ar/9vgK//r4Dv/2+A7/9vgK//74Bv/++Ab//vQG+AL7/vQG+/70BvgC+/r0Dvvy9Bb78vQG+Ar78vQS9/bwCvf+8Ab3+vAO9/LwEvf28Ar3/vAC9AL0AvQG9/bwEvfy8A7z/u/+7Arz+uwG8ALz/uwK8/rsCvP27A7z9uwO8/rsAvAG8/7sBuwC7/7oBu/+6Abv/ugK7/roCu/y6Bbv7ugS7/roAuwG7/7oAuwG7/7oBuv65A7r9uQO6/rkAugG6/7kBuv+5Abr/uQC6Abr/uQG6/7kAugG6ALr+uQO6/bkDuv64ALkBuf+4Abn/uAG5/7gBuf+4Abn/uAK5/bgCuQC5/7gBuf+4ALkBuf+4ALkBuf64Arn+twO4/rcAuAC4Abj/twK4/bcDuP23A7j9twO4/rcBuP+3Abj/twK4/rcCuP63Arj/twC4Abj+twO4/LcFt/u2BLf9tgK3/7YBt/+2ALcBt/+2ALcBt/62Arf/tgC3ALcAtwC3ALcAtwC3/7YCt/62Arf+tgG3ALcAtwC3ALf/tgK2/rUCtv61AbYAtgC2ALYAtv+1Arb9tQO2/rUBtgC2/7UBtv+1Arb9tQO2/rUBtgC2/7UBtv+1Abb/tQG2/rUDtvy1Bbb8tQK2ALb/tAK1/bQDtf60ArX+tAG1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Acv+ygPK/ckCygDK/8kByv/JAcn/yAHJAMn/yAHJ/8gByADIAMj/xwDIAcgAyADI/8cAxwHH/8YBx//GAMcBx//GAMcBxv/FAcb+xQLG/8UBxv/FAMYAxgHF/8QAxQDFAMUAxQHF/8QAxQDEAMQAxALE/cMDxPzDBMT9wwTE/MMCw/7CAsP/wgHD/sICw/7CAsP/wgDDAMMAwgDCAMIBwv7BAsL+wQHCAML/wQHCAML/wALB/cADwf7AAcEAwQDB/8ABwQDBAMEAwf/AAcH/vwLA/r8CwP2/A8D+vwHAAMD/vwHA/78CwP2/Ar8Av/++Ab8Av/6+A7/+vgG/AL//vgG//74Cv/6+Ab4Avv+9Ab4Avv69BL78vQK+AL7+vQO+/b0Dvv29A779vAK9AL3/vAG9/7wAvQG9/7wBvf68Ar3/vAC9AL0AvQC9Ab3/vP+8A7z9uwO8/bsCvP67A7z+uwC8Abz+uwO8/bsDvP27Arz/uwC8Abz/ugC7Abv+ugO7/boCu/+6ALsAuwG7/7oAuwG7/roCu/+6Abv/ugG7/roCu/+6AboAuv+5ALoAugG6/7kCuv25Arr+uQK6/7kBuv+5ALoBuv65A7r9uQK6/7kAugG6/7kAuQG5/rgDufy4Bbn7uAS5/bgCuf+4ALkAuQC5ALkBuf64Arn+uAG5Abn+uAK5/7j/uAO5+7cGuPu3A7j/t/+3Arj+twG4ALgAuAC4ALj/twG4ALgAuAG4/rcBuAC4/7cDuPy3BLj7twW4/LcDuP63AbgAuAC3/7YBt/+2Arf+tgG3ALcAtwC3/7YCt/62A7f8tgO3/rYCt/+2ALf/tgG3/7YCt/+2/7YBt/+2Arf+tgK3/bYDt/61AbYAtv+1Abb/tQG2/7UBtv+1ALYCtv21A7b9tQK2ALb/tQK2/bUDtv61Abb/tQK2/bUDtv61ALYCtv61Abb/tQG2ALYAtgC2ALYAtgC1ALUAtQC1ALUAtQC1ALUAtQC1ALUAtQC1ALUBtf60ArX/tAC1ALUAtQC1ALUAtQC1ALX/tAG1/7QBtf+0ALUBtf60A7X9tAG1AbX+tAK1ALX+tAK1/7QAtQG0/7MBtP+zAbT/swG0/7MAtAG0/7MBtP+z/7MCtP5ZA1T9UwFOAE4ASQBJAUT9PwNA/jsCPP43ATgANP8vAjD+LAIt/igDKfslBiP6IgYg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/eED4f7gAeH/3wHgAN//3gHf/90B3gDe/90B3f/cAd0A3f/bAdwA3P/aAtv92gPb/dkD2v3ZA9n+2ADZAdn/1wHYANj/1gHX/9YB1//VAtb91QPW/tUB1QDV/9QB1ADUANT/0wHU/9MC0/3SA9P80gTT/tEA0gHS/tEC0v/QANEA0QDRAdH/0ADQAND/zwPQ/c8Dz/zOBM/9zgLP/80AzgHO/s0Czv/NAM4Bzf7MA839zALN/8sBzP/LAcz+ywPM/csCy//KAMsBy//KAMsAywHK/8kByv/J/8kDyv3JA8r9yQLJ/8gByf/IAcn/yAHJAMj+xwPI/ccDyP3HAsj+xwLI/8YAxwDHAcf+xgPH/MYFx/vGBMb+xQDGAcb/xQDGAcb/xQHG/sUDxf3EA8X+xADFAcX/xAHFAMX/xALF/cMCxADE/8MCxP7DAMQBxADE/8MCxPzCBcP8wgPD/sIAwwHDAMP/wgLD/cIDw/7BAcIAwv/BAcIAwgDC/8EBwgDC/8ECwv7AAMECwf3ABMH9wAHB/8ABwQDBAcH9wATB+8AGwPq/BcD9vwHAAMAAwADAAcD+vwHAAMAAwAHA/r8BwAC/AL8AvwC//74Cv/++AL8AvwC/AL8Bv/6+Ar//vgG//r0BvgC+AL4Cvvy9BL78vQS+/b0Dvv29A77+vQG+AL7/vQG+AL0Avf+8Ar3+vAG9AL3+vAS9/LwEvfy8Ar0Avf68BL37vAW9/LwCvP+7AbwAvAC8ALz/uwK8/rsCvP67AbwAvAC8ALwAvAC8/7sCvP67Arz/uwC8/7oDu/y6A7v/uv66BLv8ugO7/roBu/+6Arv+ugG7/7oCu/66Abv/ugC7Arv+ugG6/7kBuv+5Arr+uQC6A7r7uQW6/bkAugK6/bkEuvu5Bbr8uQO6/rkBuv+5AboAuv+5Arr9uAO5/bgDuf64Abn/uAC5Abn/uAG5/7gAuQG5/7gAuQG5/7gBuf64A7n8uAW5+7gEuf24AbkBuf64Arn/t/+3A7j9twK4/7cAuAG4/7cCuP23Arj/twC4Arj+twC4Abj+twS4/LcDuP23ArgBuP63AbgAuP63A7j/t/+3Arf9tgK3ALf/tgK3/bYCtwC3/7YBt/+2ALcCt/62Abf/tgG3ALcAtwC3/7YCt/62AbcAt/+2AbcAt/62A7f9tgO3/rYBt/62Arf/tQK2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AM4AzgDO/80Czf7MAs3/zADNAMwBzP7LA8z9ywLM/8sBy/7KA8v9ygPL/coDy/3KA8v+yQHKAMr/yQHKAMoAygDJAMkAyQDJAMkAyf/IAsn+yAHIAMj/xwDIAcj+xwPI/scByP/GAMcBx/7GA8f9xgLH/sYDxv3FA8b9xQHGAcb/xQHG/8UBxv7FAsX+xALF/8QAxQDFAMUBxf/EAMUBxf7DAsT/wwHE/8MAxAHE/sMCxP/DAMMBw/7CAsP+wgLD/8IAwwDDAMMAwwHD/sECwv7BAsL+wQHCAMIAwv/BAcIAwv/BAsL9wQPC/sABwQDBAMEAwf/AAcEAwQDB/8ACwf7AAcEAwf+/AcAAwADAAMAAwP+/AsD9vwTA+78GwPq/BMD9vwK/AL//vgG//r4CvwC//r4Ev/q+B7/6vgW/+74Fv/y+BL/8vgK+Ab79vQW++r0Fvv29Ab4Bvv69Ar7+vQK+/70AvgG+/r0Cvv+8AL0Bvf+8Ab3+vAO9/LwFvfu8BL3+vAC9Ar39vAK9/7wAvQK9/bwDvfy7BLz9uwK8ALz+uwK8/7sAvAG8/7sAvAC8ALwAvAC8Abz+uwG8ALz/uwO7/LoEu/y6A7v+ugK7/roCu/+6/7oCu/66AbsBu/26A7v+ugG7ALv/ugG7/7oCu/26A7r9uQO6/bkDuv25Arr/uQC6Abr/uQG6/7kBuv+5Abr/uQG6ALr/uQG6/7kBuv+5AboAuv65A7r9uAO5/rgAuQC5Arn9uAO5/bgCuQC5/7gBuQC5/7gCuf64AbkAuQC5/7gCuf64AbkBuf24BLn8uAK5Abn+twG4ALj/twG4ALj/twG4ALj/twK4/bcDuP63AbgAuP+3Abj/twG4/7cBuP+3Abj/twC4ALgBuP+3Arj8twS4/LcFuPu3BLf9tgG3Abf+tgK3/rYBtwG3/rYCt/62AbcBt/62Arf/tgC3ALcAtwC3ALcAt/+2Arf9tgO3/bYDt/22A7f9tgK3/7YBt/62A7f9tgO2/bUDtv21A7b+tQG2/7UBtv+1AbYAtv+1AbYAtv+1Arb9tQO2/rUBtv+1Abb/tQG2/7UAtgG2/7UAtgC2Abb/tQC2ALYAtgG2/rUDtvy1BLb9tQG2Abb+tQK2/7T/tAK1/rQBtQG1/bQEtfy0A7X/tP+0A7X9tAK1/7QAWQBZAVP+UgJN/0cASAFE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");  
				snd.play();
			}