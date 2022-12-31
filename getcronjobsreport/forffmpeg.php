sudo ffmpeg -i /home/ubuntu/oops-repo/admin-panel/uploads/Videos/SER2191600950092-S-1-E-3/movSER2191600950092-S-1-E-3-5051601036554DID_Season_1_Episode_3.mp4 -c:a aac -strict experimental -c:v libx264 -s 240x320 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 /home/ubuntu/oops-repo/admin-panel/uploads/Videos/SER2191600950092-S-1-E-3/movSER2191600950092-S-1-E-3-5051601036554DID_Season_1_Episode_3.mp4_240x320.m3u8



sudo ffmpeg -i /home/ubuntu/oops-repo/admin-panel/uploads/Videos/SER2191600950092-S-1-E-3/movSER2191600950092-S-1-E-3-5051601036554DID_Season_1_Episode_3.mp4 -c:a aac -strict experimental -c:v libx264 -s 360x640 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 /home/ubuntu/oops-repo/admin-panel/uploads/Videos/SER2191600950092-S-1-E-3/movSER2191600950092-S-1-E-3-5051601036554DID_Season_1_Episode_3.mp4_360x640.m3u8


sudo ffmpeg -i /home/ubuntu/oops-repo/admin-panel/uploads/Videos/SER2191600950092-S-1-E-3/movSER2191600950092-S-1-E-3-5051601036554DID_Season_1_Episode_3.mp4 -c:a aac -strict experimental -c:v libx264 -s 480x800 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 /home/ubuntu/oops-repo/admin-panel/uploads/Videos/SER2191600950092-S-1-E-3/movSER2191600950092-S-1-E-3-5051601036554DID_Season_1_Episode_3.mp4_480x800.m3u8