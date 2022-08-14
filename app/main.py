# from starlette.applications import Starlette
# from starlette.routing import Route
# from starlette.requests import Request
# from starlette.responses import PlainTextResponse,JSONResponse,RedirectResponse
# from starlette.templating import Jinja2Templates
# from starlette.templating import php

    
    

# templates=Jinja2Templates(directory="templates")
# templates=php(directory="homepage")
# async def homepage(request):
#     return templates.TemplateResponse("index.html",context)


# app = Starlette(debug=True, routes=[
#     Route('/', homepage),
# ])


# app=Starlette()


from starlette.applications import Starlette
from starlette.responses import PlainTextResponse
from starlette.routing import Route


async def homepage(request):
    return PlainTextResponse("Homepage")

async def about(request):
    return PlainTextResponse("About")


routes = [
    Route("/", endpoint=homepage),
    Route("/about", endpoint=about),
]

app = Starlette(routes=routes)