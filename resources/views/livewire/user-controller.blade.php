<div wire:poll.900ms>
<div  id="messages" class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
@forelse($messages as $message)
    @if($message->userReceiveId == $userEm->id and $message->userSentId == auth()->user()->id)
    <!---  AUthentifiant  -->
    <!--  onmouseenter="document.getElementById('svg{{$message->id}}').style='display:block;'" -->
        <div class="chat-message">
            <div class="flex items-end justify-end">
                @if($message->type=="text")
                    <div class="flex flex-col space-y-2 text-sm-600 max-w-xs mx-2 order-1 items-end rounded-lg inline-block rounded-br-none bg-blue-600 text-white">
                        <span style="justify-content: space-between;align-content: space-between;">
                            <p class="px-6 py rounded-lg inline-block rounded-br-none bg-blue-600 text-white-900 w-40"  style="line-height: 1;font-size:0.91rem;font-weight: bold;padding-left: 10px;padding-bottom: 10px;">
                                <span style="font-size:12px ;padding-top:1px;">{{$message->created_at->format(' h:m:s  d-M-y')}} </span> <br>
                                
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="padding-left: 10px;width:90%;padding-bottom: 17px; font-size:1rem;">
                                            <b>{{\Crypt::decryptString($message->content)}} </b>
                                        </td>                                            
                                        <td>
                                            @if(Carbon\Carbon::now()->diffInHours($message->updated_at) < 3 )
                                            <a href="/remove/{{$message->id}}" >
                                                <svg  href="/remove/{{$message->id}}" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path id="svg{{$message->id}}"  d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                </svg>
                                            </a>
                                            @else
                                            @endif
                                        </td><br>
                                    </tr>
                                </table>
                            </p>
                        </span>
                    </div>
                    @elseif($message->type == "img")
                        <img src="{{ Storage::url(\Crypt::decryptString($message->content)) }}" height="220" width="220" alt="" style="border:2px solid blue;border-radius:14px 14px 0 14px;">
                    @else
                        @if(explode(".",\Crypt::decryptString($message->content))[1]=='pdf')
                            <img src="/images/filePDF.png" height="120" width="220" alt="" style="border:2px solid gray;border-radius:14px 14px 14px 0;height:9rem;">                
                        @elseif(explode(".",\Crypt::decryptString($message->content))[1]=='txt')
                            <img src="/images/fileTXT.png" height="120" width="220" alt="" style="border:2px solid gray;border-radius:14px 14px 14px 0;height:9rem;">                                            
                        @elseif(explode(".",\Crypt::decryptString($message->content))[1]=='pptx')
                            <img src="/images/filePPT.png" height="120" width="220" alt="" style="border:2px solid gray;border-radius:14px 14px 14px 0;height:9rem;">                                            
                        
                        @elseif(explode(".",\Crypt::decryptString($message->content))[1]=='wav' )
                            <audio controls id="aud" data="audio.wave" style="border-radius:40px; background:lightgray" >
                                <source src="{{ Storage::url(\Crypt::decryptString($message->content)) }}" id="src1" type="audio/ogg">
                            </audio>    
                        @elseif(explode(".",\Crypt::decryptString($message->content))[count(explode(".",\Crypt::decryptString($message->content)))-1]=='mp4' )
                            <video controls id="aud" data="audio.wave" style="border-radius:40px; background:lightgray;width:20rem;" >
                                <source src="{{ Storage::url(\Crypt::decryptString($message->content)) }}" id="src1" type="audio/ogg">
                                <source src="{{ Storage::url(\Crypt::decryptString($message->content)) }}" id="src2" type="audio/mpeg">
                            </video>    
                        
                        @else
                        <img src="/images/file.png" height="120" width="220" alt="" style="border:2px solid gray;border-radius:14px 14px 14px 0;height:9rem;">                                            
                        @endif
                    @endif
                    </div>
                    <!-- <div class="flex item-end justify-end absolute right-10 w-10 tools toolshide"  id="tools">
                        <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">supprimer</li>
                    <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">favorits</li>
                </ul>
            </div> -->
        </div>
        @elseif($message->userReceiveId == auth()->user()->id and $message->userSentId == $userEm->id)
        <div class="chat-message">
            <div class="flex items-end">
                @if($message->type == "text")
                <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start">
                    <div>
                        <span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600">
                            <span style="font-size:12px ;padding-top:1px;">{{$message->created_at->format(' h:m:s  d-M-y')}} </span> <br>
                            <b style="font-size: 1rem; letter-spacing:2px; word-spacing:0px;">{{\Crypt::decryptString($message->content)}}</b>
                        </span>
                    </div>
                </div>
                @elseif($message->type == "audio")
                    <audio controls id="aud" data="audio.wave" style="border-radius:40px; background:lightgray" >
                        <source src="/audio/{{\Crypt::decryptString($message->content)}}" id="src1" type="audio/ogg">
                        <source src="/audio/{{\Crypt::decryptString($message->content)}}" id="src2" type="audio/mpeg">
                    </audio>
                @elseif($message->type=="img")
                    <div id="Img">
                        <img src="{{ Storage::url(\Crypt::decryptString($message->content)) }}" height="220" width="220" alt="" style="border:2px solid gray;border-radius:14px 14px 14px 0;">                
                        <a href="{{ Storage::url(\Crypt::decryptString($message->content)) }}" download="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                            </svg>
                        </a>
                    </div>
                @elseif($message->type=="file")
                    <div id="FL">
                        @if(explode(".",\Crypt::decryptString($message->content))[1]=='pdf')
                            <img src="/images/filePDF.png" height="220" width="220" alt="" style="border:2px solid gray;border-radius:14px 14px 14px 0;height:8rem">                
                        @elseif(explode(".",\Crypt::decryptString($message->content))[1]=='txt')
                            <img src="/images/fileTXT.png" height="220" width="220" alt="" style="border:2px solid gray;border-radius:14px 14px 14px 0;height:8rem">                                            
                        @elseif(explode(".",\Crypt::decryptString($message->content))[1]=='pptx')
                            <img src="/images/filePPT.png" height="220" width="220" alt="" style="border:2px solid gray;border-radius:14px 14px 14px 0;height:8rem">                                            
                        @else
                            <img src="/images/filePPT.png" height="220" width="220" alt="" style="border:2px solid gray;border-radius:14px 14px 14px 0;height:8rem">                                            
                        @endif
                        <a href="{{ Storage::url(\Crypt::decryptString($message->content)) }}" download="{{now()}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
        @endif
    @empty
    aucun message entre vous.
@endforelse
    <!-- <div class="flex items-end justify-end">
            <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-1 items-end rounded-lg inline-block rounded-br-none bg-blue-600 text-white">
                <div>
                    <span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white ">
                        slm
                    </span><br>
                    <span style="font-size: 7px;" class="absolute right-0 bottom-0">
                        
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="chat-message">
        <div class="flex items-end">
            <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start">
            <div><span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600">
                cv ?
            </span></div>
            </div>
        </div>
    </div> -->
</div>
</div>
